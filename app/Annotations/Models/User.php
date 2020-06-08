<?php

namespace App\Annotations\Models;


/**
 * @OA\Schema (
 *     title="Register User",
 *     description="User model",
*      required={"imei"}
 * )
 */
class User {
    

    /**
     * @OA\Property(
     *     title="book_title",
     *     description="The title of the book",
     *     example="The green shades"
     * )
     *
     * @var string
     */
    private $book_title;
    
    /**
     * @OA\Property(
     *     title="book_author",
     *     description="The book witer",
     *     example="Janes Smith@cloudware.ng"
     * )
     *
     * @var string
     */
    private $book_author;

    /**
     * @OA\Property(
     *     title="book_description",
     *     description="Short summary",
     *     example="This is the story of a young boy that came to make all prophecies come true",
     *     format="string",
     *     type="string"
     * )
     *
     * @var string
     */
    private $book_description;

    /**
     * @OA\Property(
     *     title="book_publisher",
     *     description="Who published it",
     *     example="Spectrum",
     *     format="string",
     *     type="string"
     * )
     *
     * @var string
     */
    private $book_publisher;

    /**
     * @OA\Property(
     *     title="date_published",
     *     description="Book publication date",
     *     example="2020-06-03",
     *     format="datetime"
     * )
     *
     * @var \DateTime
     */
    private $date_published;

    /**
     * @OA\Property(
     *     title="download_link",
     *     description="Book url location",
     *     example="http://spectrumbooks.com/api/v1/download_link/eyJpdiI6IlZOb281aWJ2Z09kOU9CeTBRWmtwSlE9PSIsInZhbHVlIjoiMEhyMUJ6S3VMWit2NjNDS1RUNHAyUT09IiwibWFjIjoiMGM0MGUyNDI5ZGE1ZmQ2NjQ3YzlmMTlkNDU0YjE1YjBiMGFlMDc2MTJiMDliMGM1NjM4NzQ4YzhmM2JlMGI5MyJ9"
     * )
     *
     * @var string
     */
    private $download_link;


    /**
     * @OA\Property(
     *     title="front_cover",
     *     description="Picture url location",
     *     example="spectrumbooks.com/storage/books/front-covers/sNKgCvexbBX8ZWa1glsqOSu196NJJ05kqDGi57q4.jpeg"
     * )
     *
     * @var string
     */
    private $front_cover;
    

}