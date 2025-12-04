# Agent.md - Coding Guidelines for Extended ACF

This document provides comprehensive coding guidelines for contributing to the `schrittweiter/extended-acf` library. Follow these standards to maintain consistency and quality across the codebase.

---

## Table of Contents

1. [Project Overview](#1-project-overview)
2. [File Organization](#2-file-organization)
3. [PHP Standards](#3-php-standards)
4. [Three Field Class Patterns](#4-three-field-class-patterns)
5. [PHPDoc Standards](#5-phpdoc-standards)
6. [Naming Conventions](#6-naming-conventions)
7. [Method Guidelines](#7-method-guidelines)
8. [Trait Usage](#8-trait-usage)
9. [Constructor Patterns](#9-constructor-patterns)
10. [Validation & Error Handling](#10-validation--error-handling)
11. [Known Issues](#11-known-issues)
12. [Contributing New Fields](#12-contributing-new-fields)
13. [Complete Examples](#13-complete-examples)

---

## 1. Project Overview

### Purpose

This library extends [vinkla/extended-acf](https://github.com/vinkla/extended-acf) (WordPlate Extended ACF) by:

1. **Adding GraphQL support** to existing ACF field types via the `GraphQL` trait
2. **Creating new custom field types** for third-party ACF plugins:
   - ACF Extended Pro
   - ACF OpenStreetMap Field
   - ACF FocusPoint
   - And others

### Architecture

The library follows a **Decorator/Extension Pattern**:

- Simple extensions wrap existing field types to add GraphQL support
- Custom field types extend the base `Field` class with new functionality
- All fields use the **Fluent Builder Pattern** for method chaining

### Dependencies

| Dependency | Version | Purpose |
|------------|---------|---------|
| PHP | >= 8.1 | Language requirement |
| vinkla/extended-acf | ^13.7.1 | Base ACF field library |

### Namespace

```
Schrittweiter\Acf\              # Root namespace
Schrittweiter\Acf\Fields\       # Field classes
Schrittweiter\Acf\Fields\Settings\  # Traits (e.g., GraphQL)
```

---

## 2. File Organization

### Directory Structure

```
extended-acf/
├── src/
│   └── Fields/
│       ├── Settings/
│       │   └── GraphQL.php       # Custom traits
│       ├── Text.php              # Simple extensions
│       ├── Button.php            # Custom field types
│       ├── FlexibleContent.php   # Extended fields
│       └── ...
├── composer.json
├── README.md
└── Agent.md                      # This file
```

### File Placement Rules

| Type | Location | Example |
|------|----------|---------|
| Field classes | `src/Fields/` | `src/Fields/MyField.php` |
| Setting traits | `src/Fields/Settings/` | `src/Fields/Settings/MyTrait.php` |

### File Naming

- **File name** must match **class name** exactly (PascalCase)
- One class per file
- Example: `FlexibleContent` class → `FlexibleContent.php`

---

## 3. PHP Standards

### Strict Types (Required)

All files **must** include strict type declaration immediately after the opening PHP tag:

```php
<?php

declare(strict_types=1);
```

### Indentation

- Use **tabs** for indentation (not spaces)
- Do not mix tabs and spaces

### Braces

- Opening brace on **same line** as class/method declaration
- Closing brace on its own line

```php
class MyField extends Field
{
    public function myMethod(): self
    {
        // ...
    }
}
```

### Blank Lines

- **One blank line** between methods
- **One blank line** before `return $this;` in methods
- **One blank line** after the opening class brace (before traits)
- **No blank line** after the last method before closing class brace

```php
class MyField extends Field
{

    use GraphQL;

    public function methodOne(): self
    {
        $this->settings['key'] = 'value';

        return $this;
    }

    public function methodTwo(): self
    {
        $this->settings['other'] = true;

        return $this;
    }
}
```

### Line Length

- Maximum **120 characters** per line
- Break long method signatures or arrays across multiple lines

### Import Organization

Imports must be **grouped** in the following order, with a blank line between groups:

1. **Own namespace** (Schrittweiter)
2. **Extended ACF traits** (alphabetical within group)
3. **Extended ACF base classes**

```php
<?php

declare(strict_types=1);

namespace Schrittweiter\Acf\Fields;

// 1. Own namespace
use Schrittweiter\Acf\Fields\Settings\GraphQL;

// 2. Extended ACF traits (alphabetical)
use Extended\ACF\Fields\Settings\ConditionalLogic;
use Extended\ACF\Fields\Settings\Instructions;
use Extended\ACF\Fields\Settings\Required;
use Extended\ACF\Fields\Settings\Wrapper;

// 3. Extended ACF base classes
use Extended\ACF\Fields\Field;
```

---

## 4. Three Field Class Patterns

### Decision Flowchart

```
Is this a NEW field type (not in vinkla/extended-acf)?
├── YES → Does it need custom methods beyond GraphQL?
│         ├── YES → Type C: New Custom Field Type
│         └── NO  → Type C (minimal): New Custom Field Type
└── NO  → Are you EXTENDING an existing field with new methods?
          ├── YES → Type B: Extended Field
          └── NO  → Type A: Simple Extension (GraphQL-only)
```

### Type A: Simple Extension (GraphQL-only)

Use when you only need to add GraphQL support to an existing field type.

**Characteristics:**
- Extends the parent field class (aliased as `Field`)
- Only adds the `GraphQL` trait
- No additional methods or constructor

**Template:**

```php
<?php

declare(strict_types=1);

/**
 * Extend [FieldType] field type by "Vinkla Extended ACF"
 *
 * @link       https://schrittweiter.de
 * @since      1.0.0
 */

/**
 * Extend "WordPlate Extended" [FieldType] by following plugin: WPGraphQL for Advanced Custom Fields
 *
 * @link       https://github.com/wp-graphql/wp-graphql-acf
 * @version    [current version]
 *
 * @author     WPGraphQL <https://github.com/wp-graphql>
 */

namespace Schrittweiter\Acf\Fields;

use Schrittweiter\Acf\Fields\Settings\GraphQL;

use Extended\ACF\Fields\[FieldType] as Field;

class [FieldType] extends Field
{

    use GraphQL;
}
```

### Type B: Extended Field (GraphQL + extra methods)

Use when extending an existing field type with additional configuration methods.

**Characteristics:**
- Extends the parent field class (aliased as `Field`)
- Adds `GraphQL` trait plus custom methods
- May override constructor to set defaults

**Template:**

```php
<?php

declare(strict_types=1);

/**
 * Extend [FieldType] field type by "Vinkla Extended ACF"
 *
 * @link       https://schrittweiter.de
 * @since      1.0.0
 */

/**
 * Extend "WordPlate Extended" [FieldType] by following plugin: [Plugin Name]
 *
 * @link       [plugin URL]
 * @version    [current plugin version]
 *
 * @author     [Author] <[URL]>
 */

namespace Schrittweiter\Acf\Fields;

use Schrittweiter\Acf\Fields\Settings\GraphQL;

use Extended\ACF\Fields\[FieldType] as Field;

class [FieldType] extends Field
{

    use GraphQL;

    /**
     * Set defaults on call
     *
     * @param string $label
     * @param string|null $name
     */
    public function __construct(string $label, ?string $name = null)
    {
        parent::__construct($label, $name);

        $this->defaultMethod();
    }

    /**
     * Description of what this method does
     *
     * @return $this
     */
    public function customMethod(): self
    {
        $this->settings['custom_setting'] = true;

        return $this;
    }
}
```

### Type C: New Custom Field Type

Use when creating an entirely new field type (e.g., from ACF Extended Pro).

**Characteristics:**
- Extends `Extended\ACF\Fields\Field` directly (not aliased)
- Defines `protected ?string $type` property
- Includes multiple traits for field settings
- Has constructor with defaults

**Template:**

```php
<?php

declare(strict_types=1);

/**
 * Add [FieldType] field type to "WordPlate Extended"
 *
 * @link       https://schrittweiter.de
 * @since      1.0.0
 */

/**
 * Extend "WordPlate Extended" with [FieldType] by following plugin: [Plugin Name]
 *
 * @link       [plugin URL]
 * @version    [current plugin version]
 *
 * @author     [Author] <[URL]>
 */

namespace Schrittweiter\Acf\Fields;

use Schrittweiter\Acf\Fields\Settings\GraphQL;

use Extended\ACF\Fields\Settings\ConditionalLogic;
use Extended\ACF\Fields\Settings\Instructions;
use Extended\ACF\Fields\Settings\Required;
use Extended\ACF\Fields\Settings\Wrapper;

use Extended\ACF\Fields\Field;

class [FieldType] extends Field
{

    use GraphQL;
    use ConditionalLogic;
    use Instructions;
    use Required;
    use Wrapper;

    protected ?string $type = '[acf_field_type]';

    /**
     * Set defaults on call
     *
     * @param string $label
     * @param string|null $name
     */
    public function __construct(string $label, ?string $name = null)
    {
        parent::__construct($label, $name);

        $this->defaultSetting('value');
    }

    /**
     * Description of what this method does
     *
     * @param string $value
     *
     * @return $this
     */
    public function customMethod(string $value): self
    {
        $this->settings['custom_key'] = $value;

        return $this;
    }
}
```

---

## 5. PHPDoc Standards

### File Header (Two-Block Format)

Every file must have **two PHPDoc blocks** before the namespace:

1. **First block**: Library information (Schrittweiter)
2. **Second block**: Source plugin information

```php
<?php

declare(strict_types=1);

/**
 * [Action] [FieldType] field type [by/to] "Vinkla Extended ACF"
 *
 * @link       https://schrittweiter.de
 * @since      1.0.0
 */

/**
 * Extend "WordPlate Extended" [description] by following plugin: [Plugin Name]
 *
 * @link       [plugin documentation URL]
 * @version    [current plugin version - UPDATE WHEN PLUGIN UPDATES]
 *
 * @author     [Plugin Author] <[author URL]>
 */

namespace Schrittweiter\Acf\Fields;
```

**Action verbs:**
- `Extend` - when extending an existing field type
- `Add` - when adding a new field type

**Version tracking:**
- The `@version` tag should reflect the **source plugin version** at time of implementation
- **Update this version** when the source plugin updates and you verify compatibility

### Method Documentation

```php
/**
 * Brief description of what the method does
 *
 * Optional longer description with more details.
 * Can span multiple lines.
 *
 * Options: option1, option2, option3
 *
 * @link       [relevant documentation URL]
 *
 * @param string $value Description of the parameter
 * @param int $count Optional parameter description
 *
 * @throws \InvalidArgumentException When value is invalid
 *
 * @return $this
 */
public function methodName(string $value, int $count = 0): self
```

### Constructor Documentation

```php
/**
 * Set defaults on call
 *
 * @param string $label
 * @param string|null $name
 */
public function __construct(string $label, ?string $name = null)
```

### Documenting Allowed Options

When a method accepts specific values, document them in the PHPDoc:

```php
/**
 * Set the modal size
 *
 * Options: small, medium, large, xlarge, full
 *
 * @param string $size
 *
 * @return $this
 */
public function modalSize(string $size = 'full'): self
```

---

## 6. Naming Conventions

### Classes

- **PascalCase** (e.g., `FlexibleContent`, `DateRangePicker`, `OpenStreetMap`)
- Match the conceptual field type name
- For PHP reserved words, use plural form (e.g., `Clones` not `Clone`)

### Methods

- **camelCase** (e.g., `buttonValue`, `modalEdit`, `centerMap`)
- Use descriptive verbs or noun phrases
- Boolean toggles: use feature name without "enable/set" prefix

```php
// Good
public function advanced(): self
public function stylisedButton(): self
public function thumbnails(): self

// Avoid
public function enableAdvanced(): self
public function setStylisedButton(): self
```

### Properties

- **camelCase** with type declaration
- Use nullable types where appropriate

```php
protected ?string $type = 'acfe_button';
```

### Settings Keys vs Method Names

**Important distinction:**

| Context | Convention | Example |
|---------|------------|---------|
| Method names | `camelCase` | `buttonValue()` |
| Settings keys | `snake_case` | `$this->settings['button_value']` |

This is because ACF internally uses `snake_case` for field settings. Our methods provide a clean `camelCase` API while mapping to ACF's expected format.

```php
// Method name: camelCase
public function buttonValue(string $value): self
{
    // Settings key: snake_case (ACF convention)
    $this->settings['button_value'] = $value;

    return $this;
}
```

---

## 7. Method Guidelines

### Fluent Interface Pattern

All setter methods **must** return `$this` to enable method chaining:

```php
MyField::make('Label', 'name')
    ->required()
    ->instructions('Enter a value')
    ->customMethod('value')
    ->graphQL();
```

### Type Hints

**Required** for all parameters and return types:

```php
public function methodName(string $value, int $count, array $options): self
```

Common type hints used:
- `string` - text values
- `int` - numeric values
- `float` - decimal values (e.g., coordinates)
- `bool` - boolean flags
- `array` - lists or associative arrays
- `?string` - nullable string

### Return Type

Always use `self` as return type for fluent methods:

```php
public function myMethod(): self
{
    // ...

    return $this;
}
```

### Boolean Toggle Methods

For enabling features, use parameterless methods:

```php
/**
 * Enable advanced mode
 *
 * @return $this
 */
public function advanced(): self
{
    $this->settings['advanced_mode'] = true;

    return $this;
}
```

### Value Setter Methods

For configurable values, use typed parameters:

```php
/**
 * Set the button label
 *
 * @param string $label
 *
 * @return $this
 */
public function buttonLabel(string $label): self
{
    $this->settings['button_label'] = $label;

    return $this;
}
```

### Default Parameter Values

Use default values for optional configuration:

```php
public function modal(string $size = 'full', int $columns = 4): self
{
    $this->settings['modal_size'] = $size;
    $this->settings['modal_columns'] = $columns;

    return $this;
}
```

---

## 8. Trait Usage

### GraphQL Trait (Required)

**Every field class must include the `GraphQL` trait.** This is the primary purpose of this library.

```php
use Schrittweiter\Acf\Fields\Settings\GraphQL;

class MyField extends Field
{

    use GraphQL;
}
```

### Trait Ordering

Traits must be ordered as follows:
1. `GraphQL` (always first)
2. Other traits in **alphabetical order**

```php
class MyField extends Field
{

    use GraphQL;
    use ConditionalLogic;
    use Instructions;
    use MinMax;
    use Multiple;
    use Nullable;
    use Required;
    use Wrapper;
}
```

### Common Extended ACF Traits

| Trait | Purpose | Methods Added |
|-------|---------|---------------|
| `ConditionalLogic` | Conditional display rules | `conditionalLogic()` |
| `DateTimeFormat` | Date/time formatting | `displayFormat()`, `returnFormat()` |
| `Disabled` | Disable field | `disabled()` |
| `Instructions` | Field instructions | `instructions()` |
| `MinMax` | Min/max values | `min()`, `max()` |
| `Multiple` | Multiple selection | `multiple()` |
| `Nullable` | Allow null | `nullable()` |
| `Placeholder` | Placeholder text | `placeholder()` |
| `Required` | Required field | `required()` |
| `WeekDay` | Week start day | `weekStartsOn()` |
| `Wrapper` | Field wrapper | `wrapper()` |
| `Writable` | Read-only control | `readOnly()` |

### When to Create New Traits

Create a new trait when:
- A setting is reusable across multiple field types
- The setting is not provided by Extended ACF
- You want to maintain DRY principles

Place new traits in `src/Fields/Settings/`.

---

## 9. Constructor Patterns

### Always Call Parent Constructor

```php
public function __construct(string $label, ?string $name = null)
{
    parent::__construct($label, $name);

    // Set defaults...
}
```

### Set Defaults via Methods

**Do:** Call methods to set defaults (maintains fluent interface consistency):

```php
public function __construct(string $label, ?string $name = null)
{
    parent::__construct($label, $name);

    $this->buttonValue(__('Submit', 'acfe'));
    $this->buttonType('button');
    $this->buttonClass('button button-secondary');
}
```

**Don't:** Set `$this->settings` directly in constructor:

```php
// Avoid this pattern
public function __construct(string $label, ?string $name = null)
{
    parent::__construct($label, $name);

    $this->settings['button_value'] = __('Submit', 'acfe');
}
```

### Define Type Property for Custom Fields

For new custom field types, define the ACF field type:

```php
class Button extends Field
{

    use GraphQL;

    protected ?string $type = 'acfe_button';

    // ...
}
```

The `$type` value must match the ACF field type identifier used by the source plugin.

---

## 10. Validation & Error Handling

### Input Validation

When a method accepts specific values, validate the input:

```php
/**
 * Set the field appearance
 *
 * @param string $fieldType checkbox, multi_select, select, or radio
 *
 * @throws \InvalidArgumentException
 *
 * @return $this
 */
public function appearance(string $fieldType): self
{
    if (!in_array($fieldType, ['checkbox', 'multi_select', 'select', 'radio'])) {
        throw new \InvalidArgumentException("Invalid argument field type [$fieldType].");
    }

    $this->settings['field_type'] = $fieldType;

    return $this;
}
```

### Exception Format

Use `\InvalidArgumentException` with a descriptive message:

```php
throw new \InvalidArgumentException("Invalid argument [parameter name] [$value].");
```

### Document Allowed Values

Always document valid options in PHPDoc:

```php
/**
 * Set return format
 *
 * @param string $format array, name, or code
 *
 * @throws \InvalidArgumentException
 *
 * @return $this
 */
public function returnFormat(string $format): self
```

---

## 11. Known Issues

The following files contain legacy code that does not fully conform to these guidelines. New code should follow the standards in this document.

| File | Issue | Notes |
|------|-------|-------|
| `DateRangePicker.php` | Uses `snake_case` method names | Methods like `default_start()`, `min_range()`, `max_range()`, `min_date()`, `max_date()`, `custom_ranges()`, `no_weekends()`, `auto_close()` should be `camelCase` |
| `FlexibleContent.php:119` | Missing type hint on `$nowrap` parameter | Should be `int $nowrap = 0` |
| Most files | Missing `declare(strict_types=1)` | Only `GraphQL.php` currently has it |
| Various files | Mixed tabs/spaces in trait `use` statements | Should use consistent tabs |
| Various files | Inconsistent blank lines before `return $this` | Should always have blank line |

**Note:** When modifying these files, consider updating them to follow current guidelines.

---

## 12. Contributing New Fields

### Step-by-Step Workflow

1. **Identify the field type**
   - Determine which third-party plugin provides the field
   - Find the plugin's documentation URL
   - Note the current plugin version

2. **Choose the correct pattern**
   - Use the [decision flowchart](#decision-flowchart) to select Type A, B, or C

3. **Create the file**
   - Create `src/Fields/[FieldName].php`
   - Use the appropriate template from [Section 4](#4-three-field-class-patterns)

4. **Implement the field**
   - Add the two-block PHPDoc header
   - Include `declare(strict_types=1);`
   - Add the `GraphQL` trait (required)
   - Add other necessary traits
   - Implement custom methods following [Method Guidelines](#7-method-guidelines)

5. **Update documentation**
   - Add usage example to `README.md`
   - Include link to plugin documentation

### Pre-Submission Checklist

Before submitting your contribution, verify:

- [ ] File includes `declare(strict_types=1);`
- [ ] Two-block PHPDoc header is present
- [ ] `@version` tag reflects current plugin version
- [ ] `GraphQL` trait is included
- [ ] All traits are ordered (GraphQL first, then alphabetical)
- [ ] Imports are properly grouped (own namespace → traits → base classes)
- [ ] All methods use `camelCase` naming
- [ ] All parameters have type hints
- [ ] All methods return `self`
- [ ] Blank line before every `return $this;`
- [ ] Methods are documented with PHPDoc
- [ ] Options are documented for restricted-value methods
- [ ] Input validation uses `InvalidArgumentException`
- [ ] `README.md` updated with usage example (for new field types)

### Testing Recommendations

1. **Functional testing**: Register a field group using your new field and verify it works in WordPress admin
2. **GraphQL testing**: If using WPGraphQL, verify the field appears in the schema when `->graphQL()` is called
3. **Method chaining**: Verify all methods can be chained fluently

---

## 13. Complete Examples

### Example A: Simple Extension (Type A)

A minimal field that only adds GraphQL support to an existing type.

```php
<?php

declare(strict_types=1);

/**
 * Extend Textarea field type by "Vinkla Extended ACF"
 *
 * @link       https://schrittweiter.de
 * @since      1.0.0
 */

/**
 * Extend "WordPlate Extended" Textarea by following plugin: WPGraphQL for Advanced Custom Fields
 *
 * @link       https://github.com/wp-graphql/wp-graphql-acf
 * @version    2.4.0
 *
 * @author     WPGraphQL <https://github.com/wp-graphql>
 */

namespace Schrittweiter\Acf\Fields;

use Schrittweiter\Acf\Fields\Settings\GraphQL;

use Extended\ACF\Fields\Textarea as Field;

class Textarea extends Field
{

    use GraphQL;
}
```

### Example B: Extended Field (Type B)

A field that extends an existing type with additional methods.

```php
<?php

declare(strict_types=1);

/**
 * Extend Image field type by "Vinkla Extended ACF"
 *
 * @link       https://schrittweiter.de
 * @since      1.0.0
 */

/**
 * Extend "WordPlate Extended" Image by following plugin: Advanced Custom Fields: Extended PRO
 *
 * @link       https://www.acf-extended.com/features/fields/image
 * @version    0.9.0
 *
 * @author     ACF Extended <https://www.acf-extended.com/>
 */

namespace Schrittweiter\Acf\Fields;

use Schrittweiter\Acf\Fields\Settings\GraphQL;

use Extended\ACF\Fields\Image as Field;

class Image extends Field
{

    use GraphQL;

    /**
     * Set defaults on call
     *
     * @param string $label
     * @param string|null $name
     */
    public function __construct(string $label, ?string $name = null)
    {
        parent::__construct($label, $name);

        $this->uploader('default');
    }

    /**
     * Set the uploader type
     *
     * Options: default, basic, wp
     *
     * @link       https://www.acf-extended.com/features/fields/image#uploader
     *
     * @param string $value
     *
     * @return $this
     */
    public function uploader(string $value): self
    {
        $this->settings['uploader'] = $value;

        return $this;
    }
}
```

### Example C: New Custom Field Type (Type C)

A completely new field type from a third-party plugin.

```php
<?php

declare(strict_types=1);

/**
 * Add Slider field type to "WordPlate Extended"
 *
 * @link       https://schrittweiter.de
 * @since      1.0.0
 */

/**
 * Extend "WordPlate Extended" with Slider by following plugin: Advanced Custom Fields: Extended PRO
 *
 * @link       https://www.acf-extended.com/features/fields/slider
 * @version    0.9.0
 *
 * @author     ACF Extended <https://www.acf-extended.com/>
 */

namespace Schrittweiter\Acf\Fields;

use Schrittweiter\Acf\Fields\Settings\GraphQL;

use Extended\ACF\Fields\Settings\ConditionalLogic;
use Extended\ACF\Fields\Settings\DefaultValue;
use Extended\ACF\Fields\Settings\Instructions;
use Extended\ACF\Fields\Settings\Required;
use Extended\ACF\Fields\Settings\Wrapper;

use Extended\ACF\Fields\Field;

class Slider extends Field
{

    use GraphQL;
    use ConditionalLogic;
    use DefaultValue;
    use Instructions;
    use Required;
    use Wrapper;

    protected ?string $type = 'acfe_slider';

    /**
     * Set defaults on call
     *
     * @param string $label
     * @param string|null $name
     */
    public function __construct(string $label, ?string $name = null)
    {
        parent::__construct($label, $name);

        $this->range(0, 100);
        $this->step(1);
    }

    /**
     * Set the slider range
     *
     * @param int $min Minimum value
     * @param int $max Maximum value
     *
     * @return $this
     */
    public function range(int $min, int $max): self
    {
        $this->settings['min'] = $min;
        $this->settings['max'] = $max;

        return $this;
    }

    /**
     * Set the step increment
     *
     * @param int $step
     *
     * @return $this
     */
    public function step(int $step): self
    {
        $this->settings['step'] = $step;

        return $this;
    }

    /**
     * Set the slider unit suffix
     *
     * @param string $unit Unit to display (e.g., 'px', '%', 'em')
     *
     * @return $this
     */
    public function unit(string $unit): self
    {
        $this->settings['unit'] = $unit;

        return $this;
    }

    /**
     * Enable the reset button
     *
     * @return $this
     */
    public function resetButton(): self
    {
        $this->settings['reset'] = true;

        return $this;
    }

    /**
     * Set the slider orientation
     *
     * @param string $orientation horizontal or vertical
     *
     * @throws \InvalidArgumentException
     *
     * @return $this
     */
    public function orientation(string $orientation): self
    {
        if (!in_array($orientation, ['horizontal', 'vertical'])) {
            throw new \InvalidArgumentException("Invalid orientation [$orientation].");
        }

        $this->settings['orientation'] = $orientation;

        return $this;
    }
}
```

**Usage example for README.md:**

```php
<?php

use Schrittweiter\Acf\Fields\Slider;

Slider::make('Opacity', 'opacity')
    ->instructions('Set the opacity level')
    ->range(0, 100)
    ->step(5)
    ->unit('%')
    ->resetButton()
    ->required()
    ->graphQL();
```

---

## Quick Reference Card

| Topic | Standard |
|-------|----------|
| PHP Version | >= 8.1 |
| Strict Types | `declare(strict_types=1);` required |
| Indentation | Tabs |
| Class Names | PascalCase |
| Method Names | camelCase |
| Settings Keys | snake_case |
| Return Type | `self` |
| GraphQL Trait | Required in all fields |
| Trait Order | GraphQL first, then alphabetical |
| Import Order | Own namespace → Traits (alpha) → Base classes |
| Blank Lines | One before `return $this;` |
| Version Tag | Update when source plugin updates |

---

*Last updated: December 2024*
