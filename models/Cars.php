<?php

namespace test\models;

/**
 * @brief   Represents cars as a model
 */

class Cars
{
    /**
     * @brief    Brand of the car.
     *
     * @var      string $brand
     */

    protected $brand;

    /**
     * @brief    Age of the car.
     *
     * @var      int $age
     */

    protected $age;

    /**
     * @brief    Seeding data with a given amount of known cars by associative arrays.
     *
     * @var      array $seedData
     */

    private $seedData    =  array(
        array(
            'brand'   =>  'mercedes',
            'age'     =>  4,
        ),
        array(
            'brand'   =>  'bmw',
            'age'     =>  4,
        ),
        array(
            'brand'   =>  'audi',
            'age'     =>  4,
        ),
        array(
            'brand'   =>  'mercedes',
            'age'     =>  1,
        ),
        array(
            'brand'   =>  'citroen',
            'age'     =>  1,
        ),
        array(
            'brand'   =>  'audi',
            'age'     =>  4,
        ),
        array(
            'brand'   =>  'audi',
            'age'     =>  6
        ),
        array(
            'brand'   =>  'mercedes',
            'age'     =>  6,
        )
    );

    /**
     * @brief   constructor for Cars model
     *
     * @param   string $brand
     *
     * @param   int $age
     */

    public function __construct( string $brand = '', int $age  = 0 )
    {
        $this->brand    = $brand;

        $this->age      = $age;
    }

    /**
     * @brief      Getting desired data from the seeding data by given keys.
     *
     * @details    Comparison with the corresponding keys from seed data by given brand and age.
     *             If the requirements are met, the checked car is put inside the output array.
     *
     * @param      string $brand
     *
     * @param      int $age
     *
     * @return     array $result
     */

    public function getSeedData( $brand, $age )
    {
        /**
         * @brief   The array which will be filled up with filtered data.
         *
         * @var     array $result
         */

        $result    = array();

        /**
         * @brief   Integer for IDs for the filtered data.
         *
         * @var     int $newId
         */

        $newId   = 0;

        foreach ( $this->seedData as $key => $car )
        {
            if ( $car['brand'] ==  $brand && $car['age'] == $age )
            {
                $car['id']      = $key;
                $car['newId']   = $newId;
                array_push( $result, $car);
                $newId ++;
            }
            else
            {
                if( empty( $age ) )
                {
                    if ( $car['brand'] ==  $brand )
                    {
                        $car['id']      = $key;
                        $car['newId']   = $newId;
                        array_push( $result, $car );
                        $newId ++;
                    }
                }
                if( empty( $brand ) )
                {
                    if ( $car['age'] ==  $age )
                    {
                        $car['id']      = $key;
                        $car['newId']   = $newId;
                        array_push( $result, $car );
                        $newId ++;
                    }
                }
            }
        }

        return $result;
    }

    /**
     * @brief      Getting desired data from the seeding data by given keys.
     *
     * @details    Comparison with the corresponding keys from seed data by given brand and age.
     *             If both requirements are met, the quiz is fully answered.
     *             If only one is met, the answer is half-given.
     *
     * @param      string $brand
     *
     * @param      int $age
     *
     * @return     float|int
     */

    public function getQuizData( $brand, $age)
    {
        /**@brief   Output of the comparisons. Will be casted to float when incremented by 0,5.
         *
         * @var     int $result
         */
        $result    = 0;
        if ( isset( $brand ) && isset( $age ) )
        {
            foreach ( $this->seedData as $car )
            {
                if ( $car['brand'] ==  $brand  && $car['age'] ==  $age )
                {
                    $result++;
                    break;
                }
            }
        }
        return $result;
    }
}