<?php

/**
 * Inserts another template into the current one
 * <pre>
 *  * file : the resource name of the template
 *  * cache_time : cache length in seconds
 *  * cache_id : cache identifier for the included template
 *  * compile_id : compilation identifier for the included template
 *  * data : data to feed into the included template, it can be any array and will default to $_root (the current data)
 *  * assign : if set, the output of the included template will be saved in this variable instead of being output
 *  * rest : any additional parameter/value provided will be added to the data array
 * </pre>
 * This software is provided 'as-is', without any express or implied warranty.
 * In no event will the authors be held liable for any damages arising from the use of this software.
 *
 * @author     Jordi Boggiano <j.boggiano@seld.be>
 * @author     David Sanchez <david38sanchez@gmail.com>
 * @copyright  2008-2013 Jordi Boggiano
 * @copyright  2013-2016 David Sanchez
 * @license    http://dwoo.org/LICENSE   Modified BSD License
 * @link       http://dwoo.org/
 * @version    1.2.3
 * @date       2016-10-15
 * @package    Dwoo
 */
function Dwoo_Plugin_include(Dwoo_Core $dwoo, $file, $cache_time = null, $cache_id = null, $compile_id = null, $data = '_root', $assign = null, array $rest = array())
{
	if ($file === '') {
		return '';
	}

	if (preg_match('#^([a-z]{2,}):(.*)$#i', $file, $m)) {
		// resource:identifier given, extract them
		$resource = $m[1];
		$identifier = $m[2];
	} else {
		// get the current template's resource
		$resource = $dwoo->getTemplate()->getResourceName();
		$identifier = $file;
	}

	try {
		$include = $dwoo->templateFactory($resource, $identifier, $cache_time, $cache_id, $compile_id);
	} catch (Dwoo_Security_Exception $e) {
		$dwoo->triggerError('Include : Security restriction : '.$e->getMessage(), E_USER_WARNING);
	} catch (Dwoo_Exception $e) {
		$dwoo->triggerError('Include : '.$e->getMessage(), E_USER_WARNING);
	}

	if ($include === null) {
		$dwoo->triggerError('Include : Resource "'.$resource.':'.$identifier.'" not found.', E_USER_WARNING);
	} elseif ($include === false) {
		$dwoo->triggerError('Include : Resource "'.$resource.'" does not support includes.', E_USER_WARNING);
	}

	if (is_string($data)) {
		$vars = $dwoo->readVar($data);
	} else {
		$vars = $data;
	}

	if (count($rest)) {
		$vars = $rest + $vars;
	}

	$clone = clone $dwoo;
	$out = $clone->get($include, $vars);

	if ($assign !== null) {
		$dwoo->assignInScope($out, $assign);
	}

	foreach ($clone->getReturnValues() as $name => $value) {
		$dwoo->assignInScope($value, $name);
	}

	if ($assign === null) {
		return $out;
	}
}
