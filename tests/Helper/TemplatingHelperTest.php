<?php
/**
 * Created by PhpStorm.
 * User: stefan
 * Date: 08.12.15
 * Time: 15:12
 */

namespace TQ\Bundle\ExtDirectBundle\Tests\Helper;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use TQ\Bundle\ExtDirectBundle\Helper\TemplatingHelper;

/**
 * Class TemplatingHelperTest
 *
 * @package TQ\Bundle\ExtDirectBundle\Tests\Helper
 */
class TemplatingHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testGetApiPath()
    {
        /** @var UrlGeneratorInterface|\PHPUnit_Framework_MockObject_MockObject $urlGenerator */
        $urlGenerator = $this->createPartialMock(
            'Symfony\Component\Routing\Generator\UrlGeneratorInterface',
            array('generate', 'setContext', 'getContext')
        );

        $urlGenerator->expects($this->once())
                     ->method('generate')
                     ->with(
                         $this->equalTo('tq_extdirect_api'),
                         $this->equalTo(array(
                             'endpoint' => 'api',
                             '_format'  => 'js'
                         ))
                     )
                     ->willReturn('url');

        $extension = new TemplatingHelper($urlGenerator);
        $this->assertEquals('url', $extension->getApiPath('api'));
    }

    public function testGetJsonApiPath()
    {
        /** @var UrlGeneratorInterface|\PHPUnit_Framework_MockObject_MockObject $urlGenerator */
        $urlGenerator = $this->createPartialMock(
            'Symfony\Component\Routing\Generator\UrlGeneratorInterface',
            array('generate', 'setContext', 'getContext')
        );

        $urlGenerator->expects($this->once())
                     ->method('generate')
                     ->with(
                         $this->equalTo('tq_extdirect_api'),
                         $this->equalTo(array(
                             'endpoint' => 'api',
                             '_format'  => 'json'
                         ))
                     )
                     ->willReturn('url');

        $extension = new TemplatingHelper($urlGenerator);
        $this->assertEquals('url', $extension->getApiPath('api', 'json'));
    }
}
