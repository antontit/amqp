<?php


namespace Api\Model\Video\Entity\Video\Event;


use Api\Model\Video\Entity\Author\AuthorId;
use Api\Model\Video\Entity\Video\File;
use Api\Model\Video\Entity\Video\VideoId;

class VideoFileAdded
{
    /**
     * @var VideoId
     */
    private $id;

    /**
     * @var AuthorId
     */
    private $authorId;

    /**
     * @var File
     */
    private $file;

    public function __construct(VideoId $id, AuthorId $authorId, File $file)
    {

        $this->id = $id;
        $this->authorId = $authorId;
        $this->file = $file;
    }
}