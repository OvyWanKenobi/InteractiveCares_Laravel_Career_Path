<?php

//CONSTANTS

// class BlogPost{
//     private string $status;

//     public function getStatus(): string{
//         return $this->status;
//     }

//     public function setStatus(string $status):void{
//         $this->status = $status;
//     }
// }


// final class Status{
//     public const DRAFT = 'draft';
//     public const PUBLISHED = 'published';
//     public const UNDER_REVIEW = 'under_review';
// }

// $post = new BlogPost;
// $post->setStatus('draft');

// if($post->getStatus() === Status::DRAFT){ //if block will run is only string coming from getStatus match the value of DRAFT of class Status
// var_dump($post->getStatus());
// }


//ENUMERATION (class as a Type)

class BlogPost
{
    private Status $status;

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }
}

enum Status
{
    case DRAFT;
    case PUBLISHED;
    case UNDER_REVIEW;
}

$post = new BlogPost;
$post->setStatus(Status::DRAFT);

if ($post->getStatus() === Status::DRAFT) { //if block will run is only getStatus match the enum(Status::DRAFT)
    var_dump($post->getStatus());
}
