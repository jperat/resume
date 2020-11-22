<?php


namespace App\Service;


use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureService
{

    public const FILENAME = 'profile.jpg';
    public const SIZES = [16, 32, 57, 60, 72, 76, 96, 114, 120, 144, 152, 180, 192];

    private Imagine $imagine;
    private String $projectDir;

    public function __construct(Imagine $imagine, String $projectDir)
    {
        $this->imagine = $imagine;
        $this->projectDir = $projectDir;
    }

    public function execute(UploadedFile $picture)
    {
        $this->moveOriginalPicture($picture);
        $this->generateFavicons();
    }

    private function generateFavicons()
    {
        foreach (self::SIZES as $size) {
            $this->generateFavicon($size);
        }
    }

    private function generateFavicon(int $size)
    {
        $image = $this->getProfileImage();
        $image->resize(new Box($size, $size))
            ->save($this->getFaviconPath($size));
    }

    private function getProfileImage(): ImageInterface
    {
        return $this
            ->imagine
            ->getImagine()
            ->open($this->getImgDirectory().self::FILENAME);
    }

    private function moveOriginalPicture(UploadedFile $picture)
    {
        try {
            $picture->move(
                $this->getImgDirectory(),
                self::FILENAME
            );
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }
    }

    private function getFaviconPath(int $size): string
    {
        return $this->getImgDirectory().'favicon/'.$size.'x'.$size.'.png';
    }

    private function getImgDirectory(): string
    {
        return $this->projectDir.'/public/img/';
    }
}