<?php
/**
 * Created by PhpStorm.
 * User: Hemanshu Khodiyar
 * Date: 30/09/2020
 * Explain Why you chose to use class/trait/interface for this
 * The trait , dynamically sets and gets instance properties based on the common place method naming pattern.
 * For example, ‘setFirstName’ will set the ‘firstName’ property, where as ‘getFirstName’ will return the instances value
 * You are however able to replace ‘__CLASS__’ with ‘$this’ to provide the entire classes properties with these capabilities,
 * but I found this restriction beneficial when refactoring the code-base
 * PHP doesn't support multi inheritance, traits helps developer to reuse methods freely in several independent classes in different
 * class hierarchies. Traits reduce complexity.
 * For accessor you can inherits get and set method using this traits easily but need to follow naming pattern.
 */

trait MagicGetterSetter
{
    public function __call($method, $args)
    {
        if ( ! preg_match('/(?P<accessor>set|get)(?P<property>[A-Z][a-zA-Z0-9]*)/', $method, $match) ||
            ! property_exists(__CLASS__, $match['property'] = lcfirst($match['property']))
        ) {
            throw new BadMethodCallException(sprintf(
                "'%s' does not exist in '%s'.", $method, get_class(__CLASS__)
            ));
        }

        if ($match['accessor'] === 'get') {
            return $this->{$match['property']};
        };
        if ($match['accessor'] === 'set') {
                if ( !$args ) {
                    throw new InvalidArgumentException(sprintf("'%s' requires an argument value.", $method));
                };
                $this->{$match['property']} = $args[0];
                return $this;
        };
        return null;
    }
}

class User
{
    use MagicGetterSetter;

    /**
     * @var string
     */
    private  $name;
    /**
     * @var int
     */
    private $age;
}

$user = new User();
$user->setName('Joe Bloggs');
$user->setAge(24);

$text = sprintf("Name: %s, Age: %s\n", $user->getName(), $user->getAge());
echo $text;

