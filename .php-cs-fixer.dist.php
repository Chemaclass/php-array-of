<?php

declare(strict_types=1);

use PhpCsFixer\Finder;
use PhpCsFixer\Config;

$finder = Finder::create()
    ->files()
    ->in(__DIR__ . '/example')
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/tests');

return (new Config())
  ->setFinder($finder)
  ->setRules([
    '@PSR12' => true,
    'array_syntax' => ['syntax' => 'short'],
    'cast_spaces' => ['space' => 'single'],
    'concat_space' => ['spacing' => 'one'],
    'declare_strict_types' => true,
    'function_typehint_space' => true,
    'list_syntax' => ['syntax' => 'short'],
    'no_empty_phpdoc' => true,
    'no_empty_statement' => true,
    'no_leading_namespace_whitespace' => true,
    'no_trailing_comma_in_singleline_array' => true,
    'no_whitespace_before_comma_in_array' => true,
    'no_unused_imports' => true,
    'normalize_index_brace' => true,
    'operator_linebreak' => true,
    'phpdoc_add_missing_param_annotation' => true,
    'phpdoc_annotation_without_dot' => true,
    'phpdoc_indent' => true,
    'phpdoc_line_span' => ['const' => 'single', 'property' => 'single', 'method' => 'multi'],
    'phpdoc_order' => true,
    'phpdoc_scalar' => true,
    'phpdoc_separation' => true,
    'phpdoc_summary' => true,
    'phpdoc_trim' => true,
    'phpdoc_types' => true,
    'phpdoc_var_annotation_correct_order' => true,
    'phpdoc_var_without_name' => true,
    'single_trait_insert_per_statement' => true,
    'single_quote' => true,
    'trailing_comma_in_multiline' => true,
    'trim_array_spaces' => true,
    'void_return' => true,
    'php_unit_method_casing' => ['case' => 'snake_case'],
    'php_unit_strict' => true,
  ]);
