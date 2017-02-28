<?php

namespace Tests;

use App\Models\Exceptions\ModelValidationException;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Assert that model throw validation exception with specified messages.
     *
     * @param callable $callback
     * @param null $errors
     * @return ModelValidationException
     */
    public function assertModelValidationException(callable $callback, $errors = null)
    {
        /** @var ModelValidationException $e */
        $e = $this->assertException($callback, ModelValidationException::class);

        if ($errors !== null) {
            self::assertEquals($errors, $e->errors()->toArray());
        }

        return $e;
    }

    /**
     * Assert `callback` throw exception.
     *
     * @param callable $callback
     * @param string $expectedException
     * @param null $expectedCode
     * @param null $expectedMessage
     * @return \Exception|null
     */
    protected function assertException(callable $callback, $expectedException = 'Exception', $expectedCode = null, $expectedMessage = null)
    {
        $expectedException = ltrim((string)$expectedException, '\\');
        if (!class_exists($expectedException) && !interface_exists($expectedException)) {
            static::fail(sprintf('An exception of type "%s" does not exist.', $expectedException));
        }
        try {
            $callback();
        } catch (\Exception $e) {
            $class        = get_class($e);
            $message      = $e->getMessage();
            $code         = $e->getCode();
            $errorMessage = 'Failed asserting the class of exception';
            if ($message && $code) {
                $errorMessage .= sprintf(' (message was %s, code was %d)', $message, $code);
            } elseif ($code) {
                $errorMessage .= sprintf(' (code was %d)', $code);
            }
            $errorMessage .= '.';
            static::assertInstanceOf($expectedException, $e, $errorMessage);
            if ($expectedCode !== null) {
                static::assertEquals($expectedCode, $code, sprintf('Failed asserting code of thrown %s.', $class));
            }
            if ($expectedMessage !== null) {
                static::assertContains($expectedMessage, $message, sprintf('Failed asserting the message of thrown %s.', $class));
            }

            return $e;
        }
        $errorMessage = 'Failed asserting that exception';
        if (strtolower($expectedException) !== 'exception') {
            $errorMessage .= sprintf(' of type %s', $expectedException);
        }
        $errorMessage .= ' was thrown.';
        static::fail($errorMessage);

        return null;
    }
}
