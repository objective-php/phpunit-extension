<?php
    use Doctrine\Instantiator\Exception\InvalidArgumentException;
    use ObjectivePHP\PHPUnit\TestCase;


    class TestCaseTest extends TestCase
    {

        /**
         * @var TestCase
         */
        protected $testCase;

        public function setUp()
        {
            $this->testCase = new TestCase();
        }

        public function testExpectsException()
        {

            $this->testCase->expectsException(function () { throw new \Exception();});
            $this->addToAssertionCount(1);

            $this->expectsException(function () { throw new \Exception();}, 'Exception');
            $this->addToAssertionCount(1);

        }

        public function testExpectsExceptionFailsIfNoExceptionIsThrown()
        {

            $this->setExpectedException('\PHPUnit_Framework_AssertionFailedError');

            $this->testCase->expectsException(function ()
            {
               // no exception thrown so test should fail
            });
        }

        public function testExpectsExceptionFailsIfExceptionIsThrownWithUnexpectedMessage()
        {

            $this->setExpectedException('\PHPUnit_Framework_AssertionFailedError');

            $this->testCase->expectsException(function ()
            {
                throw new \Exception('abc');
            }, '\Exception', 'xyz');
        }

        public function testExpectsExceptionFailsIfExceptionIsThrownWithUnexpectedCode()
        {

            $this->setExpectedException('\PHPUnit_Framework_AssertionFailedError');

            $this->testCase->expectsException(function ()
            {
                throw new \Exception('abc', 1);
            }, '\Exception', 'abc', 2);
        }

        public function testExpectsExceptionFailsIfThrownExceptionDoesNotMatchExpectedExceptionClass()
        {

            $this->setExpectedException('\PHPUnit_Framework_AssertionFailedError');

            $this->testCase->expectsException(function ()
            {
                throw new DomainException();
            }, InvalidArgumentException::class);
        }


    }

