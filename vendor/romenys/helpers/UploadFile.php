<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 03/12/16
 * Time: 11:54
 */

namespace Romenys\Helpers;


use IKNSA\HelperBundle\Traits\GenerateUniqueIdTrait;

class UploadFile
{
    use GenerateUniqueIdTrait;

    const DEFAULT_UPLOAD_DIR = 'web/upload/';

    private $uploadDir;

    private $containerFiles;

    private $createDirectoryIfNotExist;

    public function __construct(array $files, $uploadDir = '', $createDirectoryIfNotExist = false)
    {
        $this->setCreateDirectoryIfNotExist($createDirectoryIfNotExist);
        $this->setUploadDir($uploadDir);
        $this->uploadFiles($files);
    }

    private function setCreateDirectoryIfNotExist($createDirectoryIfNotExist)
    {
        $this->createDirectoryIfNotExist = $createDirectoryIfNotExist;

        return $this;
    }

    private function getCreateDirectoryIfNotExist()
    {
        return $this->createDirectoryIfNotExist;
    }

    private function setUploadDir($uploadDir)
    {
        $this->uploadDir = $uploadDir === '' || $uploadDir === null ? self::DEFAULT_UPLOAD_DIR : $uploadDir;

        return $this;
    }

    private function getUploadDir()
    {
        return $this->uploadDir;
    }

    private function getFileExtension($fileName)
    {
        if (strstr($fileName, '.')) {
            $sections = (explode('.', $fileName));
            return end($sections);
        } else {
            return null;
        }
    }

    private function addFileToContainerFiles($containerFile)
    {
        $uploaded_file_name = $this->generateUniqueId('FILE_');

        if (is_uploaded_file($containerFile['tmp_name'])) {
            $uploaded_file_extension = $this->getFileExtension($containerFile["name"]);
            $fileDestination = $this->getUploadDir() . $uploaded_file_name . '.' . $uploaded_file_extension;

            if (!is_dir($this->getUploadDir()) && $this->getCreateDirectoryIfNotExist()) mkdir($this->getUploadDir(), 0777, true);

            if (move_uploaded_file($containerFile["tmp_name"], $fileDestination)) {
                $containerFile["uploaded_file_extension"] = $uploaded_file_extension;
                $containerFile["uploaded_file_name"] = $uploaded_file_name;
                $containerFile["uploaded_file_dir"] = $this->getUploadDir();
                $containerFile["uploaded_file"] = $fileDestination;

                return $containerFile;
            }
        }
    }

    private function uploadFiles(array $files)
    {
        foreach ($files as $fileContainers) {
            foreach ($fileContainers as $containerName => $containerFile) {

                if (is_string($containerFile['tmp_name'])) {
                    $addedFile = $this->addFileToContainerFiles($containerFile);

                    $this->containerFiles[$containerName] = $addedFile;
                } else {
                    $entityContainerFile[$containerName] = [];
                    foreach ($containerFile as $key => $value) {

                        foreach ($value as $fieldName => $content) {
                            $entityContainerFile[$containerName][$fieldName][$key] = $content;
                        }
                    }

                    foreach ($entityContainerFile[$containerName] as $fieldName => $containerFile) {
                        $addedFile = $this->addFileToContainerFiles($containerFile);

                        $this->containerFiles[$containerName][$fieldName] = $addedFile;
                    }
                }
            }
        }

        return $this;
    }

    public function getFiles()
    {
        return $this->containerFiles;
    }
}
