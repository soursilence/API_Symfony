<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\ArticleRepository")
 */
class Article {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=255)
     */
    private $userEmail;

    /**
     * @ORM\OneToMany(targetEntity="Answer", mappedBy="article")
     */
    protected $answers;

    /**
     * @ORM\OneToMany(targetEntity="Rate", mappedBy="article")
     */
    protected $rates;

    /**
     * Get id
     *
     * @return int
     */

    /**
     * Format, just used in the RestController
     * In theory the right way would be to create a proxy class with this property
     * that contains an Article instance, but I wanted to keep things simple.
     *
     * @var string
     */
    public $format = 'html';

    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Article
     */
    public function setContent($content) {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set userEmail
     *
     * @param string $userEmail
     *
     * @return Answer
     */
    public function setUserEmail($userEmail) {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * Get userEmail
     *
     * @return string
     */
    public function getUserEmail() {
        return $this->userEmail;
    }

    /**
     * Get getAnswers
     *
     * @return Answers
     */
    function getAnswers() {
        return $this->answers;
    }

    /**
     * Set setAnswers
     *
     * @param string $answers
     */
    function setAnswers($answers) {
        $this->answers = $answers;
    }

    /**
     * Get article
     *
     * @return Article
     */
    public function getArticle() {
        return $this;
    }

    /**
     * Get article
     *
     * @return string
     */
    public function __toString() {
        return (string) $this->title;
    }

}
