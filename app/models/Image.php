<?php 

use Config, File, Log, RecursiveDirectoryIterator, RecursiveIteratorIterator, Imagine\Image\Point, Imagine\Image\Box;

class Image {
 
        protected $imagine;
        protected $library;
 
        public function __construct()
        {
                if (!$this->imagine) {
                        $this->library = Config::get('image.library', 'gd');
 
                        if ($this->library == 'imagick') {
                                $this->imagine = new \Imagine\Imagick\Imagine();
                        } elseif ($this->library == 'gmagick') {
                                $this->imagine = new \Imagine\Gmagick\Imagine();
                        } elseif ($this->library == 'gd') {
                                $this->imagine = new \Imagine\Gd\Imagine();
                        } else {
                                $this->imagine = new \Imagine\Gd\Imagine();
                        }
                }
        }
 
        public function resize($url, $path = null, $filename = null, $width = 100, $height = null, $crop = false, $quality = 90)
        {
            if ($url)
            {
                // URL info
                $info = pathinfo($url);
         
                // The size
                if ( ! $height) $height = $width;
                if ( ! $filename) $filename = $info['basename'];
         
                // Quality
                $quality = 100;
         
                // Directories and file names
                $sourceDirPath  = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, public_path() . '/' . $info['dirname']);
                $sourceFilePath = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $sourceDirPath . '/' . $info['basename']);
                $targetDirName  = $width . 'x' . $height . ($crop ? '_crop' : '');
 
                if (! $path) {
                        $targetDirPath  = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $sourceDirPath . '/' . $targetDirName . '/');
                        $targetUrl      = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, asset($info['dirname'] . '/' . $targetDirName . '/' . $filename));
                } else {
                        $targetDirPath  = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, Config::get('image.upload_path') . $path);
                        $targetUrl              = asset(Config::get('image.upload_dir') . '/' . $path . $filename);
                }
 
                $targetFilePath = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $targetDirPath . $filename);
               
                // Create directory if missing
                try
                {
                    // Create dir if missing
                    if ( ! File::isDirectory($targetDirPath) and $targetDirPath) @File::makeDirectory($targetDirPath);
                               
                    // Set the size
                    $size = new Box($width, $height);
         
                    // Now the mode
                    $mode = $crop ? \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND : \Imagine\Image\ImageInterface::THUMBNAIL_INSET;
         
                    if ( ! File::exists($targetFilePath) or (File::lastModified($targetFilePath) < File::lastModified($sourceFilePath)))
                    {
                        $this->imagine->open($sourceFilePath)
                                      ->thumbnail($size, $mode)
                                      ->save($targetFilePath, array('quality' => $quality));
                    }
                }
                catch (\Exception $e)
                {
                    Log::error('[IMAGE SERVICE] Failed to resize image "' . $url . '" [' . $e->getMessage() . ']');
                }
         
                return $targetUrl;
            }
        }
 
        public function thumb($url, $width, $height = null)
        {
            return $this->resize($url, null, null, $width, $height, true);
        }
 
        public function upload($file, $dir = null, $createDimensions = false, $filename = null)
        {
            if ($file)
            {
                // Generate random dir
                if ( ! $dir) $dir = str_random(8);
                if ( ! $filename) $filename = $file->getClientOriginalName();  
 
                $RemoveChars[] = '/å/';
                $RemoveChars[] = '/ä/';
                $RemoveChars[] = '/ö/';
                $RemoveChars[] = '/Å/';
                $RemoveChars[] = '/Ä/';
                $RemoveChars[] = '/Ö/';

                $ReplaceWith[] = 'a';
                $ReplaceWith[] = 'a';
                $ReplaceWith[] = 'o';
                $ReplaceWith[] = 'A';
                $ReplaceWith[] = 'A';
                $ReplaceWith[] = 'O';

                $filename  = preg_replace($RemoveChars, $ReplaceWith, $filename);
 
                // Get file info and try to move
                $destination = Config::get('image.upload_path') . $dir;
                $path        = Config::get('image.upload_dir') . '/' . $dir . '/' . $filename;
                $uploaded    = $file->move($destination, $filename);
         
                if ($uploaded)
                {
                    if ($createDimensions) $this->createDimensions($path);
         
                    return $path;
                }
            }
        }
 
        public function crop($url, $width, $height, $x, $y) {
                if ($url) {
                // URL info
                $info = pathinfo($url);
                $fileName       = $info['basename'];
                $sourceDirPath  = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, public_path() . '/' . $info['dirname']);
                $sourceFilePath = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $sourceDirPath . '/' . $fileName);
                $targetDirName  = 'thumb';
                $targetDirPath  = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $sourceDirPath . '/' . $targetDirName . '/');
                $targetFilePath = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $targetDirPath . $fileName);
                $targetUrl      = $info['dirname'] . '/' . $targetDirName . '/' . $fileName;
 
                if(getimagesize($sourceFilePath)[0] < $width) {
                        $width = getimagesize($sourceFilePath)[0];
                        $x = 0;
                }
                if(getimagesize($sourceFilePath)[1] < $height) {
                        $height = getimagesize($sourceFilePath)[1];
                        $y = 0;
                }              
 
                // Create directory if missing
                try
                {
                    // Create dir if missing
                    if ( ! File::isDirectory($targetDirPath) and $targetDirPath) @File::makeDirectory($targetDirPath);
         
                    if ( ! File::exists($targetFilePath) or (File::lastModified($targetFilePath) < File::lastModified($sourceFilePath)))
                    {
                        $this->imagine->open($sourceFilePath)
                                      ->crop(new Point($x, $y), new Box($width, $height))
                                      ->thumbnail(new Box(200, 200), \Imagine\Image\ImageInterface::THUMBNAIL_INSET)
                                      ->save($targetFilePath, array('quality' => Config::get('image.quality')));
                    }
                }
                catch (\Exception $e)
                {
                        var_dump($e);
                        die();
                    Log::error('[IMAGE SERVICE] Failed to resize image "' . $url . '" [' . $e->getMessage() . ']');
                }
         
                return $targetUrl;
                }
        }
 
        public function createDimensions($url, $dimensions = array())
        {
            // Get default dimensions
            $defaultDimensions = Config::get('image.dimensions');
         
            if (is_array($defaultDimensions)) $dimensions = array_merge($defaultDimensions, $dimensions);
         
            foreach ($dimensions as $dimension)
            {
                // Get dimmensions and quality
                $width   = (int) $dimension[0];
                $height  = isset($dimension[1]) ?  (int) $dimension[1] : $width;
                $crop    = isset($dimension[2]) ? (bool) $dimension[2] : false;
                $quality = isset($dimension[3]) ?  (int) $dimension[3] : Config::get('image.quality');
         
                // Run resizer
                $img = $this->resize($url, null, null,  $width, $height, $crop, $quality);
            }
        }
 
        public function deleteImageFolder($url) {
                $info = pathinfo($url);
                $path  = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, public_path() . '/' . $info['dirname'] . '/');
 
                if (File::isDirectory($path)) {
                        $it = new RecursiveDirectoryIterator($path);
                        $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
 
                        foreach ($files as $file) {
                                if ($file->getFilename() === "." || $file->getFilename() === '..') {
                                        continue;
                                }
 
                                if ($file->isDir()) {
                                        rmdir($file->getRealPath());
                                } else {
                                        unlink($file->getRealPath());
                                }                      
                        }
                        rmdir($path);
                }
        }
 
        public function deleteImage($url) {
                if($url) {
                        $info = pathinfo($url);
                $fileName       = $info['basename'];
                $sourceDirPath  = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, public_path() . '/' . $info['dirname']);
                $sourceFilePath = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $sourceDirPath . '/' . $fileName);
 
                $path = realpath($sourceFilePath);
 
                if(is_readable($path)) {
                        unlink($path);
                        return true;
                }
        }
        return false;
        }
}