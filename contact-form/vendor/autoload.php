<?php

/**
 * SplClassLoader implementation that implements the technical interoperability
 * standards for PHP 5.3 namespaces and class names.
 *
 * https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md
 * https://github.com/keradus/SplClassLoader
 *
 * Example which loads classes for the Doctrine Common package in the
 * Doctrine\Common namespace.
 * $classLoader = new SplClassLoader('Doctrine\Common', '/path/to/doctrine');
 * $classLoader->register();
 *
 * @author Jonathan H. Wage <jonwage@gmail.com>
 * @author Roman S. Borschel <roman@code-factory.org>
 * @author Matthew Weier O'Phinney <matthew@zend.com>
 * @author Kris Wallsmith <kris.wallsmith@gmail.com>
 * @author Fabien Potencier <fabien.potencier@symfony-project.org>
 * @author Dariusz Ruminski <dariusz.ruminski@gmail.com>
 */
class SplClassLoader
{
    private $_fileExtension = '.class.php';
    private $_namespace;
    private $_includePath;
    private $_namespaceSeparator = '\\';
    public $debug = false;

    /**
     * Creates a new <tt>SplClassLoader</tt> that loads classes of the
     * specified namespace.
     *
     * @param string $ns          The namespace to use.
     * @param string $includePath The include path for all class files in the namespace.
     */
    public function __construct($ns = null, $includePath = null)
    {
        $this->_namespace = $ns;
        $this->_includePath = $includePath;
    }

    /**
     * Sets the namespace separator used by classes in the namespace of this class loader.
     *
     * @param string $sep The separator to use.
     */
    public function setNamespaceSeparator($sep)
    {
        $this->_namespaceSeparator = $sep;
    }

    /**
     * Gets the namespace separator used by classes in the namespace of this class loader.
     *
     * @return string $_namespaceSeparator
     */
    public function getNamespaceSeparator()
    {
        return $this->_namespaceSeparator;
    }

    /**
     * Sets the base include path for all class files in the namespace of this class loader.
     *
     * @param string $includePath
     */
    public function setIncludePath($includePath)
    {
        $this->_includePath = $includePath;
    }

    /**
     * Gets the base include path for all class files in the namespace of this class loader.
     *
     * @return string $includePath
     */
    public function getIncludePath()
    {
        return $this->_includePath;
    }

    /**
     * Sets the file extension of class files in the namespace of this class loader.
     *
     * @param string $fileExtension
     */
    public function setFileExtension($fileExtension)
    {
        $this->_fileExtension = $fileExtension;
    }

    /**
     * Gets the file extension of class files in the namespace of this class loader.
     *
     * @return string $fileExtension
     */
    public function getFileExtension()
    {
        return $this->_fileExtension;
    }

    /**
     * Installs this class loader on the SPL autoload stack.
     */
    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    /**
     * Uninstalls this class loader from the SPL autoloader stack.
     */
    public function unregister()
    {
        spl_autoload_unregister(array($this, 'loadClass'));
    }

    /**
     * Loads the given class or interface.
     *
     * @param  string $className The name of the class to load.
     * @return bool   whether the loading was successful
     */
    public function loadClass($className)
    {
        if ($this->debug) {
            var_dump("loadClass ($this->_namespace) $className");
        }

        if ($className[0] === "\\") {
            $className = substr ($className, 1);
        }

        if (null === $this->_namespace || $this->_namespace.$this->_namespaceSeparator === substr($className, 0, strlen($this->_namespace.$this->_namespaceSeparator))) {
            $fileName = '';
            $namespace = '';

            if (false !== ($lastNsPos = strripos($className, $this->_namespaceSeparator))) {
                $namespace = substr($className, 0, $lastNsPos);
                $className = substr($className, $lastNsPos + 1);
                $fileName = str_replace($this->_namespaceSeparator, DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
            }
            $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . $this->_fileExtension;
            $filePathName = ($this->_includePath !== null ? $this->_includePath . DIRECTORY_SEPARATOR : '') . $fileName;

            if ($this->debug) {
                var_dump("loading ($this->_namespace) $filePathName ...");
            }

            if (file_exists($filePathName)) {
                include $filePathName;
                $loaded = true;
            } else {
                $loaded = false;
            }

            if ($this->debug) {
                var_dump("loading ($this->_namespace) $filePathName " . ($loaded ? "OK" : "ERR"));
            }

            return $loaded;
        }

        return false;
    }
}
