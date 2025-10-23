'use strict';
const MANIFEST = 'flutter-app-manifest';
const TEMP = 'flutter-temp-cache';
const CACHE_NAME = 'flutter-app-cache';

const RESOURCES = {"android-icon-144x144.png": "a34113deefedc78dd77164f361202697",
"android-icon-192x192.png": "e7c53bf8bcc0285d697a4c95d9191dbd",
"android-icon-36x36.png": "786dd8fc6ffbb8c0058b1ecc85ca4f66",
"android-icon-48x48.png": "a4c7fb904f7ab76de2f9c0dd7d47bbb0",
"android-icon-72x72.png": "2351985b0e47fe24d3bebb72a731c876",
"android-icon-96x96.png": "2753c1f922877ad356f014455257cb0c",
"apple-icon-114x114.png": "16b7a8d7900f0b505ecdd3e198d1a329",
"apple-icon-120x120.png": "236a4c03e6490b9138bcc56424b5f581",
"apple-icon-144x144.png": "a34113deefedc78dd77164f361202697",
"apple-icon-152x152.png": "e1a699481e0e9b8dcbdf810203bad24e",
"apple-icon-180x180.png": "f436076cf5e31760795ffaec20f22779",
"apple-icon-57x57.png": "62fca1c6eee93048ff8e453867235b84",
"apple-icon-60x60.png": "bc5aa989f3826a27ff2afc1b5f8a30b9",
"apple-icon-72x72.png": "2351985b0e47fe24d3bebb72a731c876",
"apple-icon-76x76.png": "f9293763324ac7623bb0a670ffc74663",
"apple-icon-precomposed.png": "40cf34c39de835641c6fd05668263075",
"apple-icon.png": "40cf34c39de835641c6fd05668263075",
"assets/AssetManifest.bin": "f78f354fafa7675b96c440719b22bb15",
"assets/AssetManifest.bin.json": "9c539eb49d417c4b6382c6d3854b47c1",
"assets/AssetManifest.json": "dff27b04dde56415e029b1c3128854f6",
"assets/assets/images/logo-removebg-preview%2520(1).png": "571c5069d82b36a895e8409ea94953d4",
"assets/assets/images/photo_2025-09-24_16-46-16.jpg": "cc78a30ccc3f87bd30ca5da8ca78bfc5",
"assets/FontManifest.json": "97c2528ecc2fbf4093965257fdba1854",
"assets/fonts/MaterialIcons-Regular.otf": "e31a88ab035566b57af52532878d079d",
"assets/NOTICES": "8a40a72a649b0f6669078249812801a5",
"assets/packages/cupertino_icons/assets/CupertinoIcons.ttf": "33b7d9392238c04c131b6ce224e13711",
"assets/packages/flutter_inappwebview/assets/t_rex_runner/t-rex.css": "5a8d0222407e388155d7d1395a75d5b9",
"assets/packages/flutter_inappwebview/assets/t_rex_runner/t-rex.html": "16911fcc170c8af1c5457940bd0bf055",
"assets/packages/flutter_inappwebview_web/assets/web/web_support.js": "509ae636cfdd93e49b5a6eaf0f06d79f",
"assets/packages/font_awesome_flutter/lib/fonts/Font%2520Awesome%25207%2520Brands-Regular-400.otf": "440da663f17184f21f007a3a2bf60f69",
"assets/packages/font_awesome_flutter/lib/fonts/Font%2520Awesome%25207%2520Free-Regular-400.otf": "571052dce2c5fdff0250f4504380ebbe",
"assets/packages/font_awesome_flutter/lib/fonts/Font%2520Awesome%25207%2520Free-Solid-900.otf": "626e9321acfe8aa030e374a464212cd8",
"assets/shaders/ink_sparkle.frag": "ecc85a2e95f5e9f53123dcaf8cb9b6ce",
"browserconfig.xml": "653d077300a12f09a69caeea7a8947f8",
"canvaskit/canvaskit.js": "140ccb7d34d0a55065fbd422b843add6",
"canvaskit/canvaskit.js.symbols": "58832fbed59e00d2190aa295c4d70360",
"canvaskit/canvaskit.wasm": "07b9f5853202304d3b0749d9306573cc",
"canvaskit/chromium/canvaskit.js": "5e27aae346eee469027c80af0751d53d",
"canvaskit/chromium/canvaskit.js.symbols": "193deaca1a1424049326d4a91ad1d88d",
"canvaskit/chromium/canvaskit.wasm": "24c77e750a7fa6d474198905249ff506",
"canvaskit/skwasm.js": "1ef3ea3a0fec4569e5d531da25f34095",
"canvaskit/skwasm.js.symbols": "0088242d10d7e7d6d2649d1fe1bda7c1",
"canvaskit/skwasm.wasm": "264db41426307cfc7fa44b95a7772109",
"canvaskit/skwasm_heavy.js": "413f5b2b2d9345f37de148e2544f584f",
"canvaskit/skwasm_heavy.js.symbols": "3c01ec03b5de6d62c34e17014d1decd3",
"canvaskit/skwasm_heavy.wasm": "8034ad26ba2485dab2fd49bdd786837b",
"favicon-16x16.png": "456c6d567045be1cb61ecefc15152464",
"favicon-32x32.png": "d0be852e402ba34337e813a3164dd0fb",
"favicon-96x96.png": "2753c1f922877ad356f014455257cb0c",
"favicon.ico": "40b131d103657ba272fdd1b49bf5701a",
"favicon.png": "5dcef449791fa27946b3d35ad8803796",
"flutter.js": "888483df48293866f9f41d3d9274a779",
"flutter_bootstrap.js": "b5d07da2b94cace6bb9f8c16f67e2479",
"icons/Icon-192.png": "ac9a721a12bbc803b44f645561ecb1e1",
"icons/Icon-512.png": "96e752610906ba2a93c65f8abe1645f1",
"icons/Icon-maskable-192.png": "c457ef57daa1d16f64b27b786ec2ea3c",
"icons/Icon-maskable-512.png": "301a7604d45b3e739efc881eb04896ea",
"index.html": "06173c9ad145d49ccc6d0e2b5abc54b6",
"/": "06173c9ad145d49ccc6d0e2b5abc54b6",
"main.dart.js": "c5c9e60d6d33e0547a625f07f01711f1",
"main.dart.js_1.part.js": "92d7fb02949835b2f6099e40870791c1",
"main.dart.js_10.part.js": "3696d9c2704cbd8d8f543330102a3191",
"main.dart.js_11.part.js": "77d3922f5ecd4331d0a2172c5573c286",
"main.dart.js_12.part.js": "412b0f4318449951f7d311d123c46ba2",
"main.dart.js_13.part.js": "90bea97929d8a0b32e00d339dc673f3c",
"main.dart.js_14.part.js": "10accbf2027fbdf8ab055c1ff48ccbe8",
"main.dart.js_19.part.js": "c6ecf4b5bb7a9f6071040dda7d3d90e4",
"main.dart.js_21.part.js": "7cc14dbb2ca1d051ef20e6b921929ffb",
"main.dart.js_22.part.js": "8d3632ea0ed2fba356a53f98a3d9f07a",
"main.dart.js_23.part.js": "00f972a45bb4c87595f69d9855887572",
"main.dart.js_24.part.js": "27dbfe83c41b7d48101ac8bd23678b59",
"main.dart.js_25.part.js": "40f37c4428a03ed5ae8e8a8f63c66994",
"main.dart.js_6.part.js": "1b04bf27db9968189c42629972f8f750",
"main.dart.js_8.part.js": "872e385d85a76ef2295c660bda0e1221",
"main.dart.js_9.part.js": "5c063c38c7b50d760c3c5e0b115d34d0",
"manifest.json": "4811d6cc652bb1994401636469cc8fd2",
"ms-icon-144x144.png": "a34113deefedc78dd77164f361202697",
"ms-icon-150x150.png": "226333fef1e862433ae090bec1782c15",
"ms-icon-310x310.png": "919357e068ac35c4e72ad7bed1d6745a",
"ms-icon-70x70.png": "4a0e048c128a9cc7da0b7232e21c055b",
"sw.js": "02f92cb1de84bede823e4739f8b10baa",
"version.json": "271762d3952f3cfaf518a5b05d5d097b"};
// The application shell files that are downloaded before a service worker can
// start.
const CORE = ["main.dart.js",
"index.html",
"flutter_bootstrap.js",
"assets/AssetManifest.bin.json",
"assets/FontManifest.json"];

// During install, the TEMP cache is populated with the application shell files.
self.addEventListener("install", (event) => {
  self.skipWaiting();
  return event.waitUntil(
    caches.open(TEMP).then((cache) => {
      return cache.addAll(
        CORE.map((value) => new Request(value, {'cache': 'reload'})));
    })
  );
});
// During activate, the cache is populated with the temp files downloaded in
// install. If this service worker is upgrading from one with a saved
// MANIFEST, then use this to retain unchanged resource files.
self.addEventListener("activate", function(event) {
  return event.waitUntil(async function() {
    try {
      var contentCache = await caches.open(CACHE_NAME);
      var tempCache = await caches.open(TEMP);
      var manifestCache = await caches.open(MANIFEST);
      var manifest = await manifestCache.match('manifest');
      // When there is no prior manifest, clear the entire cache.
      if (!manifest) {
        await caches.delete(CACHE_NAME);
        contentCache = await caches.open(CACHE_NAME);
        for (var request of await tempCache.keys()) {
          var response = await tempCache.match(request);
          await contentCache.put(request, response);
        }
        await caches.delete(TEMP);
        // Save the manifest to make future upgrades efficient.
        await manifestCache.put('manifest', new Response(JSON.stringify(RESOURCES)));
        // Claim client to enable caching on first launch
        self.clients.claim();
        return;
      }
      var oldManifest = await manifest.json();
      var origin = self.location.origin;
      for (var request of await contentCache.keys()) {
        var key = request.url.substring(origin.length + 1);
        if (key == "") {
          key = "/";
        }
        // If a resource from the old manifest is not in the new cache, or if
        // the MD5 sum has changed, delete it. Otherwise the resource is left
        // in the cache and can be reused by the new service worker.
        if (!RESOURCES[key] || RESOURCES[key] != oldManifest[key]) {
          await contentCache.delete(request);
        }
      }
      // Populate the cache with the app shell TEMP files, potentially overwriting
      // cache files preserved above.
      for (var request of await tempCache.keys()) {
        var response = await tempCache.match(request);
        await contentCache.put(request, response);
      }
      await caches.delete(TEMP);
      // Save the manifest to make future upgrades efficient.
      await manifestCache.put('manifest', new Response(JSON.stringify(RESOURCES)));
      // Claim client to enable caching on first launch
      self.clients.claim();
      return;
    } catch (err) {
      // On an unhandled exception the state of the cache cannot be guaranteed.
      console.error('Failed to upgrade service worker: ' + err);
      await caches.delete(CACHE_NAME);
      await caches.delete(TEMP);
      await caches.delete(MANIFEST);
    }
  }());
});
// The fetch handler redirects requests for RESOURCE files to the service
// worker cache.
self.addEventListener("fetch", (event) => {
  if (event.request.method !== 'GET') {
    return;
  }
  var origin = self.location.origin;
  var key = event.request.url.substring(origin.length + 1);
  // Redirect URLs to the index.html
  if (key.indexOf('?v=') != -1) {
    key = key.split('?v=')[0];
  }
  if (event.request.url == origin || event.request.url.startsWith(origin + '/#') || key == '') {
    key = '/';
  }
  // If the URL is not the RESOURCE list then return to signal that the
  // browser should take over.
  if (!RESOURCES[key]) {
    return;
  }
  // If the URL is the index.html, perform an online-first request.
  if (key == '/') {
    return onlineFirst(event);
  }
  event.respondWith(caches.open(CACHE_NAME)
    .then((cache) =>  {
      return cache.match(event.request).then((response) => {
        // Either respond with the cached resource, or perform a fetch and
        // lazily populate the cache only if the resource was successfully fetched.
        return response || fetch(event.request).then((response) => {
          if (response && Boolean(response.ok)) {
            cache.put(event.request, response.clone());
          }
          return response;
        });
      })
    })
  );
});
self.addEventListener('message', (event) => {
  // SkipWaiting can be used to immediately activate a waiting service worker.
  // This will also require a page refresh triggered by the main worker.
  if (event.data === 'skipWaiting') {
    self.skipWaiting();
    return;
  }
  if (event.data === 'downloadOffline') {
    downloadOffline();
    return;
  }
});
// Download offline will check the RESOURCES for all files not in the cache
// and populate them.
async function downloadOffline() {
  var resources = [];
  var contentCache = await caches.open(CACHE_NAME);
  var currentContent = {};
  for (var request of await contentCache.keys()) {
    var key = request.url.substring(origin.length + 1);
    if (key == "") {
      key = "/";
    }
    currentContent[key] = true;
  }
  for (var resourceKey of Object.keys(RESOURCES)) {
    if (!currentContent[resourceKey]) {
      resources.push(resourceKey);
    }
  }
  return contentCache.addAll(resources);
}
// Attempt to download the resource online before falling back to
// the offline cache.
function onlineFirst(event) {
  return event.respondWith(
    fetch(event.request).then((response) => {
      return caches.open(CACHE_NAME).then((cache) => {
        cache.put(event.request, response.clone());
        return response;
      });
    }).catch((error) => {
      return caches.open(CACHE_NAME).then((cache) => {
        return cache.match(event.request).then((response) => {
          if (response != null) {
            return response;
          }
          throw error;
        });
      });
    })
  );
}
