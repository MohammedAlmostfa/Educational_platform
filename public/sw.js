// web/sw.js
// 🚀 التعديل الهام: زيادة رقم إصدار الكاش (لحل مشكلة الكاش)
const CACHE_NAME = 'aqaviatec-v1.0.4'; 
const RUNTIME_CACHE = 'runtime-v1';

// الملفات التي نريد تخزينها بشكل دائم (مع الأيقونات الضرورية فقط)
const PRECACHE_URLS = [
    './',
    './index.html',
    './manifest.json',
    './favicon.ico',
    './favicon-32x32.png',
    './favicon-16x16.png',
    './favicon-96x96.png',
    
    // ✅ الأيقونات المتبقية فقط
    './apple-icon-180x180.png',
    './android-icon-192x192.png',
    './ms-icon-144x144.png',

    // ملفات Flutter الأساسية 
    './flutter_bootstrap.js',
    './main.dart.js'
];

// التثبيت - تخزين الملفات الأساسية
self.addEventListener('install', event => {
    console.log('🛠️ Service Worker: Installing');
    self.skipWaiting();

    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                console.log('📦 Service Worker: Caching App Shell');
                return cache.addAll(PRECACHE_URLS)
                    .then(() => {
                        console.log('✅ All files cached successfully');
                    })
                    .catch(error => {
                        console.log('❌ Cache failed for some files:', error);
                    });
            })
    );
});

// التنشيط - تنظيف الكاش القديم
self.addEventListener('activate', event => {
    console.log('🚀 Service Worker: Activated');
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cache => {
                    // فقط احذف الكاش الذي لا يطابق الاسم الجديد
                    if (cache !== CACHE_NAME && cache !== RUNTIME_CACHE) {
                        console.log('🗑️ Service Worker: Clearing Old Cache', cache);
                        return caches.delete(cache);
                    }
                })
            );
        }).then(() => {
            console.log('✅ Service Worker: Ready to handle fetches');
            return self.clients.claim();
        })
    );
});

// اعتراض الطلبات - استراتيجية Cache First لملفات Flutter
self.addEventListener('fetch', event => {
    // تجاهل طلبات غير GET وطلبات chrome-extension
    if (event.request.method !== 'GET' ||
        event.request.url.startsWith('chrome-extension://') ||
        event.request.url.includes('chrome-extension')) {
        return;
    }

    event.respondWith(
        caches.match(event.request)
            .then(cachedResponse => {
                // إذا كان الملف موجود في الكاش
                if (cachedResponse) {
                    console.log('📁 Serving from cache:', event.request.url);

                    // تحديث الكاش في الخلفية للملفات المهمة
                    if (shouldUpdateInBackground(event.request)) {
                        updateCacheInBackground(event.request);
                    }

                    return cachedResponse;
                }

                // إذا لم يكن في الكاش، حمله من الشبكة
                console.log('🌐 Fetching from network:', event.request.url);
                return fetch(event.request)
                    .then(response => {
                        // تأكد أن الاستجابة صالحة للتخزين
                        if (isCacheable(response, event.request)) {
                            cacheResponse(event.request, response.clone());
                        }
                        return response;
                    })
                    .catch(error => {
                        console.log('❌ Network failed:', error);
                        // يمكنك إرجاع صفحة بديلة هنا إذا أردت
                        return new Response('Network error happened', {
                            status: 408,
                            headers: { 'Content-Type': 'text/plain' }
                        });
                    });
            })
    );
});

// دالة لتحديد إذا كان يجب تحديث الملف في الخلفية
function shouldUpdateInBackground(request) {
    const url = request.url;
    // حدد الملفات التي تريد تحديثها في الخلفية
    return url.includes('main.dart.js') ||
        url.includes('flutter_bootstrap.js') ||
        url.endsWith('.html');
}

// دالة لتحديث الكاش في الخلفية
function updateCacheInBackground(request) {
    fetch(request)
        .then(response => {
            if (response.status === 200 && isCacheable(response, request)) {
                cacheResponse(request, response);
                console.log('🔄 Background cache updated:', request.url);
            }
        })
        .catch(() => {
            // تجاهل الأخطاء في التحديث الخلفي
        });
}

// دالة لتحديد إذا كان يمكن تخزين الاستجابة
function isCacheable(response, request) {
    return response.status === 200 &&
        response.type === 'basic' &&
        !request.url.includes('google-signin') &&
        !request.url.includes('auth');
}

// دالة لتخزين الاستجابة في الكاش
function cacheResponse(request, response) {
    caches.open(RUNTIME_CACHE)
        .then(cache => {
            cache.put(request, response);
        })
        .catch(error => {
            console.log('❌ Cache put failed:', error);
        });
}

// استمع لرسائل من الصفحة الرئيسية
self.addEventListener('message', event => {
    if (event.data && event.data.type === 'SKIP_WAITING') {
        self.skipWaiting();
    }
});
