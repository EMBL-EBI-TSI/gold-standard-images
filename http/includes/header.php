<?php
header('Content-type: text/plain');

// Read defaults
include "builds/defaults.php";

// Build options (overwrite defaults)
if ($_GET['build']) {
  list($buildtype, $build) = explode('/', $_GET['build'], '2');

  # Build type default options
  $buildfile = "builds/$buildtype/defaults.php";
  if (!file_exists($buildfile)) {
    echo "# Build type '$buildtype' not found... using $hardware defaults\n\n";
    $buildtype = $hardware;
    $buildfile = "builds/$buildtype/defaults.php";
  }
  include $buildfile;

  # Build options
  $buildfile = "builds/$buildtype/$build.php";
  if (!file_exists($buildfile)) {
    echo "# Build '$build' not found... continuing with defaults\n\n";
  }
  include $buildfile;
}

// OS (overwrite defaults)
if ($_GET['os']) {
  list($os_name, $os_version) = explode('-', $_GET['os'], 2);
}

// Set hostname and domain
if ($fqdn) {
  list($hostname, $domain) = explode('.', $fqdn, 2);
}

// Read packer variables
include "builds/packer/vars.php";
?>
