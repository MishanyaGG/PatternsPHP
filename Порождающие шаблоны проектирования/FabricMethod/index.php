<?php

require_once ('Data/HiringManager.php');
require_once ('Data/Interviewer.php');
require_once ('Data/DeveloperManager.php');
require_once ('Data/MarketingManager.php');
require_once ('Data/CommunityExecutive.php');
require_once ('Data/Developer.php');

$devManager = new DeveloperManager();
$devManager->takeInterview();

$marketingManager = new MarketingManager();
$marketingManager->takeInterview();