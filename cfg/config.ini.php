<?php
################################################################################
# Configuration File. Please save it in UNIX UTF-8(no BOM).                    #
# ---------------------------------------------------------------------------- #
class iConfig {                                                                #
# ============================================================================ #
# Database Configuration                                                       #
# ---------------------------------------------------------------------------- #
const DB_TYPE       =         'mysql'; # Database Type                         #
const DB_NAME       =          'test'; # Database Name                         #
const DB_HOST       =     'localhost'; # Database Address                      #
const DB_PORT       =            3306; # Database Port                         #
const DB_USER       =      'username'; # Database Username                     #
const DB_PSWD       =      'password'; # Database Password                     #
# ============================================================================ #
# Board Configuation                                                           #
# ---------------------------------------------------------------------------- #
const LANGUAGE      =         'zh-CN'; # Board Language Setting                #
const TABLE_NAME    =        'sougou'; # Name of the Table Used in Database    #
const FORUM_NAME    =        'Random'; # Name of the Forum                     #
const BOARD_NAME    =      'Anonchan'; # Name of the Board                     #
const TRIPCODE_SALT =  'YW5vbmNoYW4='; # Salt in the Tripcode                  #
# ---------------------------------------------------------------------------- #
# During installation, change $TRIPCODE_SALT to any string *ONCE AND FOR ALL*. #
# ============================================================================ #
# Forum Configuation                                                           #
# ---------------------------------------------------------------------------- #
const COOL_DOWN         = 30; # Minimum time(sec) between posting two threads. #
const REFRESH_DURATION  =  5; # Duration to refresh page after posting/erring. #
const REPLIES_PER_PAGE  = 20; # Recommended. Higher value may make server lag. #
const THREADS_PER_PAGE  = 20; # Recommended. Higher value may make server lag. #
const RECENT_REPLIES    =  5; # Recommended. An interger value between 0 & 20. #
const SHOW_LIKER =2147483647; # MAX amount of UIDs of recent likers/dislikers. #
const SHOW_DISLIKER     =  0; # -1: Hide the amount and UID; 0: Hide UID only. #
const HIDE_RATIO        =  1; # Reply will hide if dislikers OUTNUMBER likers. #
const HIDE_DIVIATION    =  5; # DISLIKES > HIDE_RATIO * LIKES + HIDE_DIVIATION #
const ADMIN_PASSWORD    = ''; # Password of the Administrator if valid string. #
public static $BLACKLIST = array('00000000', '99999999', 'AAAAAAAA', 'ZZZZZZZZ'); 
                              # A Blacklist example forbiding people to reply. #
                              # Which contains 8-digit UID of whom you've ban. #
                              # You may add as many UID-tripcodes as you like. #
const LOCAL_TIMEZONE =    +8; # Timezone where users live. E.g., Myanmar +6.5. # 
const WEB_ANALYTICS  = 'Here quotes codes from Web-analytics Service Provider.';
}                                                                              #
# ---------------------------------------------------------------------------- #
# If the code is consisted of multiple lines. Just join them into single line. #
# If you want to make someone admin, specify the key as a string and share it. #
# ============================================================================ #
# THIS IS THE END OF THE CONFIGURATION FILE. DON'T ADD '?' AND '>' AT THE END. #
################################################################################