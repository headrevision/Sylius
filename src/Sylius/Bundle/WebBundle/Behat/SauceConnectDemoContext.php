<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\WebBundle\Behat;

use Behat\Mink\Exception\ExpectationException;
use Behat\MinkExtension\Context\RawMinkContext;

/**
 * Sauce Connect demo context.
 *
 * @author Fabian Kiss <fabian.kiss@ymc.ch>
 */
class SauceConnectDemoContext extends RawMinkContext
{
    /**
     * @Given /^I visit (.+)$/
     */
    public function iVisitWebsite($url)
    {
        $this->getSession('selenium2')->visit($url);
    }

    /**
     * @Then /^I should be on the (.+) website$/
     */
    public function iShouldBeOnTheWebsite($domain)
    {
        if (!$this->currentUrlContains($domain)) {
            $message = sprintf('Current URL should contain "%s".', $domain);
            throw new ExpectationException($message, $this->getSession('selenium2'));
        }
    }

    protected function currentUrlContains($domain)
    {
        $currentUrl = $this->getSession('selenium2')->getCurrentUrl();
        return strpos($currentUrl, $domain) !== false;
    }
}
