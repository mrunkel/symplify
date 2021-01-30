<?php

declare(strict_types=1);

namespace Symplify\PHPStanRules\Tests\Rules\PreferConstantValueRule;

use Iterator;
use Nette\Utils\Strings;
use PHPStan\Rules\Rule;
use Symplify\PHPStanExtensions\Testing\AbstractServiceAwareRuleTestCase;
use Symplify\PHPStanRules\Rules\PreferConstantValueRule;

final class PreferConstantValueRuleTest extends AbstractServiceAwareRuleTestCase
{
    /**
     * @dataProvider provideData()
     * @param mixed[] $expectedErrorMessagesWithLines
     */
    public function testRule(string $filePath, array $expectedErrorMessagesWithLines): void
    {
        $this->analyse([$filePath], $expectedErrorMessagesWithLines);
    }

    public function provideData(): Iterator
    {
        yield [__DIR__ . '/Fixture/SkipNotFoundInConstantValue.php', []];
        yield [__DIR__ . '/Fixture/FoundInConstantValue.php', [
            [sprintf(PreferConstantValueRule::ERROR_MESSAGE, 'Symplify\ComposerJsonManipulator\ValueObject\ComposerJsonSection', 'REQUIRE', 'require'), 11],
        ]];
    }

    protected function getRule(): Rule
    {
        return $this->getRuleFromConfig(
            PreferConstantValueRule::class,
            __DIR__ . '/config/configured_rule.neon'
        );
    }
}