Zend Debugger installation instructions
---------------------------------------

1. Extract the Zend Debugger package.

2. Locate the ZendDebugger.so (Unix) or ZendDebugger.dll (Windows) file in the directory which
   corresponds to your version of PHP (5.4.x,5.5.x) 

3. Add the following line to your php.ini file:
   Linux and Mac OS X:      zend_extension=<full_path_to_ZendDebugger.so>
   Windows non-thread safe: zend_extension=<full_path_to_ZendDebugger.dll>
   
4. Add the following lines to your php.ini file:
   zend_debugger.allow_hosts=<host_ip_addresses> 

   (*) hopst_ip_addresses are the IPs of the hosts which will be allowed to initiate debug sessions

5. Copy the dummy.php file to your document root directory.

6. Restart your Web server.

Note: Windows debuggers are built with VC9.

