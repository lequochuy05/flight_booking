<?php
class PersonInfo {
    private $title;
    private $firstName;
    private $lastname;
    private $day;
    private $month;
    private $year;
    private $nationality;

    public function __construct($title, $firstName, $lastname, $day, $month, $year, $nationality) {
        $this->title = $title;
        $this->firstName = $firstName;
        $this->lastname = $lastname;
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;
        $this->nationality = $nationality;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setLastName($lastname) {
        $this->lastname = $lastname;
    }

    public function setDay($day) {
        $this->day = $day;
    }

    public function setMonth($month) {
        $this->month = $month;
    }

    public function setYear($year) {
        $this->year = $year;
    }

    public function setNationality($nationality) {
        $this->nationality = $nationality;
    }

    public function getTitle() {    
        return $this->title;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastname;
    }

    public function getDay() { 
        return $this->day;
    }

    public function getMonth() {
        return $this->month;
    }

    public function getYear() {
        return $this->year;
    }

    public function getNationality() {  
        return $this->nationality;
    }
}
?>