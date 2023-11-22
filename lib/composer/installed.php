<?php return array(
    'root' => array(
        'name' => 'mrkwp/mrk-search-exclude',
        'pretty_version' => '1.0.1.x-dev',
        'version' => '1.0.1.9999999-dev',
        'reference' => '07f2bf154387884a943ca62c9bd9b48e2d9be802',
        'type' => 'project',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        'composer/installers' => array(
            'pretty_version' => 'v1.12.0',
            'version' => '1.12.0.0',
            'reference' => 'd20a64ed3c94748397ff5973488761b22f6d3f19',
            'type' => 'composer-plugin',
            'install_path' => __DIR__ . '/./installers',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'mrkwp/mrk-search-exclude' => array(
            'pretty_version' => '1.0.1.x-dev',
            'version' => '1.0.1.9999999-dev',
            'reference' => '07f2bf154387884a943ca62c9bd9b48e2d9be802',
            'type' => 'project',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'roundcube/plugin-installer' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '*',
            ),
        ),
        'shama/baton' => array(
            'dev_requirement' => false,
            'replaced' => array(
                0 => '*',
            ),
        ),
    ),
);
