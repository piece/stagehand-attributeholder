<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/**
 * PHP version 5
 *
 * Copyright (c) 2008 KUBO Atsuhiro <iteman@users.sourceforge.net>,
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    Stagehand_AttributeHolder
 * @copyright  2008 KUBO Atsuhiro <iteman@users.sourceforge.net>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License (revised)
 * @version    SVN: $Id$
 * @since      File available since Release 0.1.0
 */

namespace Stagehand;

// {{{ Stagehand\AttributeHolder

/**
 * An attributes holder for any purpose.
 *
 * @package    Stagehand_AttributeHolder
 * @copyright  2008 KUBO Atsuhiro <iteman@users.sourceforge.net>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License (revised)
 * @version    Release: @package_version@
 * @since      Class available since Release 0.1.0
 */
abstract class AttributeHolder
{

    // {{{ properties

    /**#@+
     * @access public
     */

    /**#@-*/

    /**#@+
     * @access protected
     */

    /**#@-*/

    /**#@+
     * @access private
     */

    private $_attributes = array();

    /**#@-*/

    /**#@+
     * @access public
     */

    // }}}
    // {{{ __set()

    /**
     * Sets an attribute for the object.
     * If the object has the setter method for the attribute then it is used.
     *
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value)
    {
        if (method_exists($this, "set$name")) {
            $this->{ "set$name" }($value);
            return;
        }

        $this->setAttribute($name, $value);
    }

    // }}}
    // {{{ __get()

    /**
     * Gets an attribute for the object.
     * If the object has the getter method for the attribute then it is used.
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (method_exists($this, "get$name")) {
            return $this->{ "get$name" }();
        }

        return $this->getAttribute($name);
    }

    // }}}
    // {{{ __isset()

    /**
     * Returns whether the object has an attribute with a given name.
     *
     * @param string $name
     * @return boolean
     */
    public function __isset($name)
    {
        return $this->hasAttribute($name);
    }

    // }}}
    // {{{ __unset()

    /**
     * Removes an attribute from the object.
     *
     * @param string $name
     */
    public function __unset($name)
    {
        $this->removeAttribute($name);
    }

    // }}}
    // {{{ setAttribute()

    /**
     * Sets an attribute for the object.
     *
     * @param string $name
     * @param mixed  $value
     */
    public function setAttribute($name, $value)
    {
        $this->_attributes[$name] = $value;
    }

    // }}}
    // {{{ hasAttribute()

    /**
     * Returns whether the object has an attribute with a given name.
     *
     * @param string $name
     * @return boolean
     */
    public function hasAttribute($name)
    {
        return array_key_exists($name, $this->_attributes);
    }

    // }}}
    // {{{ getAttribute()

    /**
     * Gets an attribute for the object.
     *
     * @param string $name
     * @return mixed
     */
    public function getAttribute($name)
    {
        return @$this->_attributes[$name];
    }

    // }}}
    // {{{ removeAttribute()

    /**
     * Removes an attribute from the object.
     *
     * @param string $name
     */
    public function removeAttribute($name)
    {
        unset($this->_attributes[$name]);
    }

    // }}}
    // {{{ clearAttributes()

    /**
     * Removes all attributes from the object.
     */
    public function clearAttributes()
    {
        $this->_attributes = array();
    }

    // }}}
    // {{{ hold

    /**
     * Holds an attribute name for the object.
     *
     * @param string $name
     */
    public function hold($name)
    {
        if (!$this->hasAttribute($name)) {
            $this->setAttribute($name, null);
        }
    }

    /**#@-*/

    /**#@+
     * @access protected
     */

    /**#@-*/

    /**#@+
     * @access private
     */

    /**#@-*/

    // }}}
}

// }}}

/*
 * Local Variables:
 * mode: php
 * coding: iso-8859-1
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * indent-tabs-mode: nil
 * End:
 */
