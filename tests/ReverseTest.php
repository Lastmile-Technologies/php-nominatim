<?php
/**
 * Class ReverseTest
 *
 * @package      maxh\Nominatim\Test
 * @author       Maxime Hélias <maximehelias16@gmail.com>
 */

namespace maxh\Nominatim\Test;

class ReverseTest extends \PHPUnit_Framework_TestCase
{

    protected $url = 'http://nominatim.openstreetmap.org/';

    /**
     * Contain url of the current application
     * @var \maxh\Nominatim\Nominatim
     */
    private $nominatim;

    /**
     * @throws \maxh\Nominatim\Exceptions\NominatimException
     */
    protected function setUp()
    {
        $this->nominatim = new \maxh\Nominatim\Nominatim($this->url);
    }

    public function testAddress()
    {
        /** @var \maxh\Nominatim\Reverse $reverse */
        $reverse = $this->nominatim->newReverse()
            ->latlon(43.4843941, -1.4960842);

        $expected = [
            'format' => 'json',
            'lat' => 43.4843941,
            'lon' => -1.4960842,
        ];


        $query = $reverse->getQuery();
        $this->assertSame($expected, $query);

        $expected = http_build_query($query);
        $this->assertSame($expected, $reverse->getQueryString());
    }
}
