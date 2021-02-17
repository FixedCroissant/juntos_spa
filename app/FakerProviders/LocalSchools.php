<?php

namespace App\FakerProviders;
use Faker\Provider\Base;

class LocalSchools extends Base
{
    /**
     * List of grades in HighSchool
     **/
    protected static $gradeList = array(
        '9th Grade',
        '10th Grade',
        '11th Grade',
        '12th Grade'
    );

    /**
     * Academic years the individual signed up.
     */

    protected static $yearList = array(
      '2018-2019',
      '2019-2020'
    );

    /**
     * List of local high schools in the North Carolina Region.
     */

    protected static $localSchools = array(
        'School 1',
        'School 2',
    );

    /**
     * List of counties involved in the Juntos Program.
     */

    protected static $countyList = array(
        'County 1',
        'County 2',
        'County 3',
        'County 4',
        'County 5'

    );

    /**
     * List of beginning GPAs that a student could possibly have
     * in highschool, some are better than others.
     */

    protected static $beginningGPAs = array(
        'No Starting GPA',
        '1.0',
        '2.0',
        '3.0',
        '4.0'
    );

    /**
     * List of ending GPAs that a student could possibly have
     * in highschool, some are better than others.
     */

    protected static $endingGPAs = array(
        '1.0',
        '2.0',
        '3.0',
        '4.0'
    );

    //Pick from the grade List
    /**
     * @example '9th Grade'
     */

     public static function grade()
     {
       return static::randomElement(static::$gradeList);
     }

    //Pick from the Year List
    /**
     * @example '2018-2019'
     */

    public static function yearSchoolStart()
    {
        return static::randomElement(static::$yearList);
    }

    /**
     * Pick from local highschools.
     * @example '2018-2019'
     */

    public static function localHighSchool()
    {
        return static::randomElement(static::$localSchools);
    }

    /**
     * Pick from local counties.
     * @example 'Pender'
     */

    public static function county()
    {
        return static::randomElement(static::$countyList);
    }

    /**
     * Pick from a list of beginning gpas.
     */

    public static function beginGPA()
    {
        return static::randomElement(static::$beginningGPAs);
    }

    /**
     * Pick from a list of ending gpas.
     */

    public static function endGPA()
    {
        return static::randomElement(static::$endingGPAs);
    }









}
