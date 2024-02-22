<?php

// Google Drive API Configuration
define('CLIENT_ID', '850197840621-q2a5n7dqbhn3l3g4dkc83kd2eclmjb7u.apps.googleusercontent.com');
define('CLIENT_SECRET', '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');
define('REDIRECT_URI', 'http://localhost:8000/google_drive.php');
define('API_KEY', '-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDUbOSkeojWjM7r\nU5cv7PU/mRU7amZKOXLhS8swey/nhIvgCUk2/jWnYvszeZc6Kzq66xYYic/LyX2w\nNgLYG1w9tASHoIC7GhfLAmO4zEOZqaQzKsMrWcs1+7YufC7BEOUtvv2kU7WNrrti\nOgEfXj1CaloIZaebd3GXJsqQ6kGAYeTgnzzvI6rMAU5ka/CXhXyLczrqqmq38ljs\nfyfIiz7kRV+gw4XhiCUJjKUeNxuxy0DfF3I75jBB9CTwT8NVl+68jJpWtIxHk9/h\nWgJNeYzDLgqKjYdsL/z5FAljQPIcENsiqGZL0CIVbSRSaP3lT8p2ekicpwzoq9sF\n3KIN+ApDAgMBAAECggEAB/KPPj8B0p2P7BGuKjXOhLc6cWiULUGD+6Dh0RSWWaAM\n1hsEnNZ+g4IzPzmb3Bv/msqSEOUSKgOF510bSHfKeb2fgfwudpGU9U4rMUqePfY/\nPJxkWiTpuc+ZOgrH7FwF2bI+36szpU/D+jNT6mx4P0R8IxAtr/tppmEe/kKoFmCI\n2BhDpflnaEacRlDUYujulIk82+ZtUlElphc3NAyijpQfk21gjiqtkITAldQ1oiKS\nvrdwECbBaf8/X4n1roZhgD0kTLisGU8vz9Y7CajM36NThgXP7ofnWwl1lQLSS+qH\n24dapg2PB76MWB/5UDFJobJ3hJXq2usb5Ul1l6SzkQKBgQD9dTNogq6H+I9viy2h\nOO9sb/D3+13ZygONmI38FPs11/ahcZ4kF5DAp5IE9RWt2/1yLCV/nS6LARRTADHW\nOxeodTFwQFMPxRInVEs/hR2vtiPSZKaBJy9Z9Z5YnGn3ySXOFgoeMcePfwgvvr5r\n5JleOIvOJb2YHt9Jl6WMEVHg8QKBgQDWjlWB+ayQtn/AWKZKMxQ9XwbkdgqKV/2E\n6lfCq1xBfJoECemWbzfbTg5wxNKfhqFcKFTldJW8RaAWXrf8DX7xi7pN2XfUsG10\nC8Y0kZXXN2WMA6ItvXnsTr0yZS1ZJx1CcQG0dmxvWPXIILdBpO8lT4OLEMYe4mKH\nB5qmhw/ecwKBgFJvAuhT0HXytpv9tTqBbQVkpwfQXmbOGDe+TTeWj1mkwtchP+DX\nNUIjfg9UstdX/GdcyllmAtQ85qJUJuFZWMl2TD0I/rrbSps2BD9FiTEz2RS9nZXV\n68WjZ/vD64cmicAsVOAbKp+WHlCBBifLMsJ9O6MxjSdjqxWhV7tliq7RAoGBAKb5\ncExNvWGF1dggZZGbPOYiHSARSVSu86rMIW5ro8mHKel4uWQMvACdN5nFY1EpGky5\nSpCj8Z/q45JlNnQfIKrkniHV228Xuqa0PxVMM7ug7hNQBJfqPIeOI6mjme4nBZte\njQAfpXXmWqjb5SJeNIrp3aqNbFI+xoTlgxKUS+JHAoGBAO4e7UX+s91N0u9VxDKr\nHyDUSsRJuKBy6FLDlL9c9xhwgak7/Dx30LC1nX42/MbQfLOxoZ39lNFsXQ24Nztl\nc6HOjSBJQk2stmELvZGuFQOFsDd8bdwCLJqDuzwXLDngeHQHnTczkYemHzzL6m6x\nyXNj4CL+FMJoOSc8RjfqJS9q\n-----END PRIVATE KEY-----\n');
define('GOOGLE_OAUTH_SCOPE', 'https://www.googleapis.com/auth/drive');
define('CLIENT_CREDENTIALS', __DIR__ . '/credentials.json');

// MySQL Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'google_driver_api_foler_manage');

// Google Drive Folder Configuration
define('ROOT_FOLDER_NAME', 'google_dirve_folder_manage_test');
