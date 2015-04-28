<?php
Interface TableSize {
	const MAX_INTEGER     = 2147483647;
	const LEN_ID          =          4;
	const LEN_PARENT      =          4;
	const LEN_UPDATEDAT   =          4;
	const LEN_CREATEDAT   =          4;
	const LEN_REPLYCOUNT  =          4;
	const LEN_UID         =          8;
	const LEN_NAME        =        255;
	const LEN_EMAIL       =        255;
	const LEN_TITLE       =        255;
	const LEN_IMAGE       =        255;
	const LEN_CONTENT     =       2048;
	const LEN_PWD         =          8;
	const LEN_LIKE        =          4;
	const LEN_LIKER       =        252; # Comma Separated
	const LEN_DISLIKE     =          4;
	const LEN_DISLIKER    =        252; # Comma Separated
	const LEN_RECENTREPLY =          4;
	const LEN_REPLYRECORD =       2000;
}
#