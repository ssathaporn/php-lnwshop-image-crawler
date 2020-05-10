<?php
    require 'vendor/autoload.php';
    use Spatie\ImageOptimizer\OptimizerChainFactory;
    $optimizerChain = OptimizerChainFactory::create();

    // $factory = new \ImageOptimizer\OptimizerFactory();
    // $optimizer = $factory->get();

    var_dump($optimizerChain);
    $filepath = 'C:\wamp64\www\lnwshop\images\177\a13ekh.jpg';
    var_dump($optimizerChain->optimize($filepath));

?>