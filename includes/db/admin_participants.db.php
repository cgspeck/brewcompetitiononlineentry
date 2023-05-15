<?php
// auto-enrol all judges into the single judging session
mysqli_query($connection, "UPDATE brewer SET brewerJudgeLocation = (SELECT CONCAT('Y-', id) FROM judging_locations ORDER BY id ASC LIMIT 1) WHERE brewerJudge = 'Y';") or die (mysqli_error($connection));
// auto-enrol all stewards into the single judging session
mysqli_query($connection, "UPDATE brewer SET brewerStewardLocation = (SELECT CONCAT('Y-', id) FROM judging_locations ORDER BY id ASC LIMIT 1) WHERE brewerSteward = 'Y';") or die (mysqli_error($connection));

$query_participant_count = sprintf("SELECT COUNT(*) as 'count' FROM %s", $prefix."brewer");
if (SINGLE) $query_participant_count .= sprintf(" WHERE FIND_IN_SET('%s',brewerCompParticipant) > 0)",$_SESSION['comp_id']);
$result_participant_count = mysqli_query($connection,$query_participant_count) or die (mysqli_error($connection));
$row_participant_count = mysqli_fetch_assoc($result_participant_count);
?>