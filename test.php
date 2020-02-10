<?php

class Test {
    private $foo;

    public function setFoo($foo) {
        $this->foo = $foo;
    }

    public function getFoo() {
        return $this->foo;
    }
}

$testInstance = new Test();

$testInstance->setFoo(3);

$foo = $testInstance->getFoo();
echo "$foo\n";

$b = null;
if($b) {
    echo "truthy\n";
} else {
    echo "falsey\n";
}

?>