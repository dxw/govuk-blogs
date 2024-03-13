<?php

return function (\Evenement\EventEmitterInterface $emitter) {
	$dot = new \Peridot\Reporter\Dot\DotReporterPlugin($emitter);
};
