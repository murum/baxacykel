<?php

define("SECOND", 1);
define("MINUTE", 60 * SECOND);
define("HOUR", 60 * MINUTE);
define("DAY", 24 * HOUR);
define("MONTH", 30 * DAY);

function relativeTime($time)
{
    $delta = time() - $time;

    if ($delta < 1 * MINUTE)
    {
        return $delta == 1 ? "en sekund sen" : $delta . " sekunder sen";
    }
    if ($delta < 2 * MINUTE)
    {
      return "en minut sen";
    }
    if ($delta < 45 * MINUTE)
    {
        return floor($delta / MINUTE) . " minuter sen";
    }
    if ($delta < 90 * MINUTE)
    {
      return "en timme sen";
    }
    if ($delta < 24 * HOUR)
    {
      return floor($delta / HOUR) . " timmar sen";
    }
    if ($delta < 48 * HOUR)
    {
      return "igår";
    }
    if ($delta < 30 * DAY)
    {
        return floor($delta / DAY) . " dagar sen";
    }
    if ($delta < 12 * MONTH)
    {
      $months = floor($delta / DAY / 30);
      return $months <= 1 ? "en månad sen" : $months . " månader sen";
    }
    else
    {
        $years = floor($delta / DAY / 365);
        return $years <= 1 ? "ett år sen" : $years . " år sen";
    }
}

function time_to_string($time)
{
    if ($time < 1 * MINUTE)
    {
        return $time == 1 ? "en sekund" : $time . " sekunder";
    }
    if ($time < 2 * MINUTE)
    {
      return "en minut";
    }
    if ($time < 45 * MINUTE)
    {
        return floor($time / MINUTE) . " minuter";
    }
    if ($time < 90 * MINUTE)
    {
      return "en timme";
    }
    if ($time < 24 * HOUR)
    {
      return floor($time / HOUR) . " timmar";
    }
    if ($time < 48 * HOUR)
    {
      return "en dag";
    }
    if ($time < 30 * DAY)
    {
        return floor($time / DAY) . " dagar";
    }
    if ($time < 12 * MONTH)
    {
      $months = floor($time / DAY / 30);
      return $months <= 1 ? "en månad" : $months . " månader";
    }
    else
    {
        $years = floor($time / DAY / 365);
        return $years <= 1 ? "ett år" : $years . " år";
    }
}    

function robbery_string_builder(
        $required_level, 
        $has_cooldown = null, 
        $full_garage = null,
        $got_jailed = null,
        $jail_seconds = null,
        $zero_bikes_by_npc = null,
        $lucky_rob_cooldown_reduce = null,
        $lucky_robber = null,
        $bikes = null,
        $experience = null,
        $garage_full_after_rob = null
    ) {

    // If required level fails
    if( !$required_level) {
        return 'Du har inte tillräckligt hög level för att baxa här';
    } 
    // If user has cooldown
    else if($has_cooldown) {
        return 'Du har väntetid som du behöver vänta ut innan du kan baxa igen.';
    } 
    // If garage is full
    else if($full_garage) {
        return 'Du behöver sälja dina cyklar eller bygga ut ditt garage före du kan baxa på nytt, ditt garage är nämligen fullt.';
    } 
    // If user got jailed
    else if ($got_jailed) {
        return 'Du hade otur med farbror blå, du tvingas därför vänta '.$jail_seconds.' sekunder innan du kan baxa på nytt';
    }
    // If got 0 bikes 
    else if ($zero_bikes_by_npc) {
        return 'Du lyckades med det största misslyckandet någonsin, du blev nedbrottad av enklaste bytet och fick inte med dig några cyklar alls.';
    } else {
        // If reduced cooldown luck and not a luck with bike amount and garage is full after current rob
        if(
            $lucky_rob_cooldown_reduce 
            && !$lucky_robber
            && $garage_full_after_rob) {
            return 'Du fick med dig '.$bikes.'st cyklar och din erfarenhet ökade också med  '.$experience.' XP. Nu är det dags att sälja dina cyklar eller uppgradera ditt garage som nu är fullt. Utöver detta hade du en väldig tur då du hittade en genväg på hemvägen som kortade din väntetid med 50%';
        }
        // If not reduced cooldown luck and not a luck with bike amount and garage is full after current rob
        else if(
            !$lucky_rob_cooldown_reduce 
            && !$lucky_robber
            && $garage_full_after_rob) {
                return 'Du fick med dig '.$bikes.'st cyklar och din erfarenhet ökade också med  '.$experience.' XP. Nu är det dags att sälja dina cyklar eller uppgradera ditt garage är nu fullt';
        }
        // If reduced cooldown luck and not a luck with bike amount and garage is not full after current rob
        else if(
            $lucky_rob_cooldown_reduce 
            && !$lucky_robber
            && !$garage_full_after_rob) {
                return 'Du fick med dig '.$bikes.'st cyklar och din erfarenhet ökade också med  '.$experience.' XP. Du lyckades också få lifta med en lastbilschaffis, med detta kan du snabbt återställa dig och väntetiden minskade därmed med 50%';
        }
        // If reduced cooldown luck and a luck with bike amount and garage is not full after current rob
        else if(
            $lucky_rob_cooldown_reduce 
            && $lucky_robber
            && !$garage_full_after_rob) {
                return 'Du fick med dig '.$bikes.'st cyklar och din erfarenhet ökade också med  '.$experience.' XP. Flax Flax Flax, du fick skjuts av en senil gubbe som gav dig en mycket snabbare väg hem samtidigt som han hade några cyklar i sitt egna garage som du fick med vilket dubblade din cykelskörd. Skjutsen han gav dig minskade också väntetiden med 50%';
        }
        // If not reduced cooldown luck but a lucky rob with bike amount and garage is full after current rob
        else if(
            !$lucky_rob_cooldown_reduce 
            && $lucky_robber
            && !$garage_full_after_rob) {
                return 'Du fick med dig '.$bikes.'st cyklar och din erfarenhet ökade också med  '.$experience.' XP. Påvägen hem hittade du även ett dike fullt med cyklar, du tog med dem hem och dubblade på så sätt din cykelskörd för den här baxningen.';
        }
        // If not reduced cooldown luck but a lucky rob with bike amount and garage is full after current rob
        else if(
            !$lucky_rob_cooldown_reduce 
            && !$lucky_robber
            && !$garage_full_after_rob) {
                return 'Du fick med dig '.$bikes.'st cyklar och din erfarenhet ökade också med '.$experience.' XP.';
        } else {
            return 'Du fick med dig '.$bikes.'st cyklar och din erfarenhet ökade också med '.$experience.' XP.';
        }
    }
}