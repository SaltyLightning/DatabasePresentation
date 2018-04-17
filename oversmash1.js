var http = require('http');

var owjs = require('overwatch-js');

//// Search for a player ( you must have the exact username, if not Blizzard api will return a not found status)
owjs
    .getOverall('pc', 'us', 'Xay-11653')
    .then((data) => console.dir(data, {depth : 4, colors : true}) );

// Output:
// { name: 'bob-12345',
//   accounts:
//    [ { level: 440,
//        portrait: 'https://blzgdapipro-a.akamaihd.net/game/unlocks/xyz.png',
//        displayName: 'bob#12345',
//        platform: 'pc' } ] }

// Get detailed stats about a user (for a specific region), including
// achievements unlocked, per-career and per-hero stats, and their
// current competitive rank
// ow.playerStats('bob-12345', 'us', 'pc').then(player => {
//     console.log(player)
// })

// Output:
// { name: 'bob-12345',
//   region: 'us',
//   platform: 'pc',
//   stats:
//    { competitiveRank: 3700,
//      achievements:
//       [ { name: 'centenary', achieved: true },
//         { name: 'level_10', achieved: true },
//         { name: 'level_25', achieved: true },
//         { name: 'level_50', achieved: true },
//         { name: 'undying', achieved: true },
//         { name: 'survival_expert', achieved: true },
//         /* ... etc ... */],
//      quickplay:
//       { all: { /* avg stats across all characters */ }
//         reaper:
//          { combat:
//             { melee_final_blows: 190,
//               solo_kills: 2922,
//               objective_kills: 6592,
//               final_blows: 9519,
//               damage_done: 6897,
//               eliminations: 18456,
//               environmental_kills: 83,
//               multikills: 155 },
//            assists:
//             { healing_done: 1102,
//               recon_assists: 25,
//               teleporter_pads_destroyed: 18 },
//            best:
//             { eliminations_most_in_game: 44,
//               final_blows_most_in_game: 27,
//               damage_done_most_in_game: 17491,
//   /* ... etc ... */