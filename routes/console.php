<?php

Schedule::command('portfolio:insert-history')->daily();
Schedule::command('portfolio:update-value')->everyFiveMinutes();
