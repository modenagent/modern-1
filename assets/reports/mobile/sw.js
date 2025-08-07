/**
 * Modern Agent - Service Worker for PWA functionality
 * 
 * Provides offline caching, background sync, and push notifications
 * for mobile property reports.
 * 
 * @version 1.0.0
 * @author Modern Agent Development Team
 * @since January 2024
 */

const CACHE_NAME = 'modern-agent-reports-v1.0.0';
const STATIC_CACHE = 'modern-agent-static-v1.0.0';
const DYNAMIC_CACHE = 'modern-agent-dynamic-v1.0.0';
const REPORTS_CACHE = 'modern-agent-reports-v1.0.0';

// Resources to cache immediately on install
const STATIC_ASSETS = [
    // Core app shell
    '/',
    '/index.php',
    
    // CSS files
    '/assets/reports/mobile/css/mobile.css',
    '/assets/css/bootstrap.min.css',
    
    // JavaScript files
    '/assets/reports/mobile/js/mobile-report.js',
    '/assets/js/jquery.min.js',
    
    // External CDN resources (cache for offline)
    'https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css',
    
    // Fonts
    '/assets/fonts/bariol_bold-webfont.woff2',
    '/assets/fonts/bariol_regular-webfont.woff2',
    
    // Icons and images
    '/assets/reports/mobile/images/icon-192x192.png',
    '/assets/reports/mobile/images/icon-512x512.png',
    '/assets/dummy_logo.png',
    
    // Offline fallbacks
    '/offline.html',
    '/assets/reports/mobile/images/offline-placeholder.png'
];

// Network-first resources (always try network first)
const NETWORK_FIRST = [
    '/api/',
    '/application/controllers/api/'
];

// Cache-first resources (serve from cache if available)
const CACHE_FIRST = [
    '/assets/',
    'https://fonts.googleapis.com/',
    'https://fonts.gstatic.com/',
    'https://cdnjs.cloudflare.com/',
    'https://cdn.jsdelivr.net/'
];

// Stale-while-revalidate resources
const STALE_WHILE_REVALIDATE = [
    '/temp/html/',
    '.html',
    '.php'
];

/**
 * Service Worker Install Event
 * Cache static assets immediately
 */
self.addEventListener('install', (event) => {
    console.log('🔧 Service Worker installing...');
    
    event.waitUntil(
        caches.open(STATIC_CACHE)
            .then((cache) => {
                console.log('📦 Caching static assets...');
                return cache.addAll(STATIC_ASSETS);
            })
            .then(() => {
                console.log('✅ Static assets cached successfully');
                return self.skipWaiting(); // Activate immediately
            })
            .catch((error) => {
                console.error('❌ Error caching static assets:', error);
            })
    );
});

/**
 * Service Worker Activate Event
 * Clean up old caches
 */
self.addEventListener('activate', (event) => {
    console.log('🚀 Service Worker activating...');
    
    event.waitUntil(
        caches.keys()
            .then((cacheNames) => {
                return Promise.all(
                    cacheNames.map((cacheName) => {
                        // Delete old versions of caches
                        if (cacheName.startsWith('modern-agent-') && 
                            ![STATIC_CACHE, DYNAMIC_CACHE, REPORTS_CACHE].includes(cacheName)) {
                            console.log('🗑️ Deleting old cache:', cacheName);
                            return caches.delete(cacheName);
                        }
                    })
                );
            })
            .then(() => {
                console.log('✅ Service Worker activated successfully');
                return self.clients.claim(); // Take control immediately
            })
            .catch((error) => {
                console.error('❌ Error during activation:', error);
            })
    );
});

/**
 * Service Worker Fetch Event
 * Handle all network requests with appropriate caching strategies
 */
self.addEventListener('fetch', (event) => {
    const { request } = event;
    const url = new URL(request.url);
    
    // Skip non-GET requests
    if (request.method !== 'GET') {
        return;
    }
    
    // Skip Chrome extension requests
    if (url.protocol === 'chrome-extension:') {
        return;
    }
    
    // Determine caching strategy based on URL
    if (isNetworkFirst(url)) {
        event.respondWith(networkFirst(request));
    } else if (isCacheFirst(url)) {
        event.respondWith(cacheFirst(request));
    } else if (isStaleWhileRevalidate(url)) {
        event.respondWith(staleWhileRevalidate(request));
    } else if (isReportRequest(url)) {
        event.respondWith(reportsCacheStrategy(request));
    } else {
        // Default: Network first with cache fallback
        event.respondWith(networkFirst(request));
    }
});

/**
 * Network First Strategy
 * Try network first, fallback to cache
 */
async function networkFirst(request) {
    try {
        // Try network first
        const networkResponse = await fetch(request);
        
        // Cache successful responses
        if (networkResponse.status === 200) {
            const cache = await caches.open(DYNAMIC_CACHE);
            cache.put(request, networkResponse.clone());
        }
        
        return networkResponse;
        
    } catch (error) {
        console.log('🌐 Network failed, trying cache:', request.url);
        
        // Fallback to cache
        const cachedResponse = await caches.match(request);
        if (cachedResponse) {
            return cachedResponse;
        }
        
        // Fallback to offline page for HTML requests
        if (request.headers.get('accept')?.includes('text/html')) {
            return caches.match('/offline.html');
        }
        
        // Return error response
        return new Response('Offline', {
            status: 503,
            statusText: 'Service Unavailable'
        });
    }
}

/**
 * Cache First Strategy
 * Serve from cache if available, fallback to network
 */
async function cacheFirst(request) {
    const cachedResponse = await caches.match(request);
    
    if (cachedResponse) {
        return cachedResponse;
    }
    
    try {
        const networkResponse = await fetch(request);
        
        if (networkResponse.status === 200) {
            const cache = await caches.open(STATIC_CACHE);
            cache.put(request, networkResponse.clone());
        }
        
        return networkResponse;
        
    } catch (error) {
        console.error('❌ Cache first failed:', error);
        return new Response('Resource not available', {
            status: 404,
            statusText: 'Not Found'
        });
    }
}

/**
 * Stale While Revalidate Strategy
 * Serve from cache immediately, update cache in background
 */
async function staleWhileRevalidate(request) {
    const cache = await caches.open(DYNAMIC_CACHE);
    const cachedResponse = await cache.match(request);
    
    // Fetch from network in background
    const networkResponsePromise = fetch(request)
        .then((networkResponse) => {
            if (networkResponse.status === 200) {
                cache.put(request, networkResponse.clone());
            }
            return networkResponse;
        })
        .catch((error) => {
            console.log('Background fetch failed:', error);
        });
    
    // Return cached response immediately if available
    if (cachedResponse) {
        return cachedResponse;
    }
    
    // Wait for network response if no cache
    return networkResponsePromise;
}

/**
 * Reports Cache Strategy
 * Special handling for report HTML and PDF files
 */
async function reportsCacheStrategy(request) {
    const cache = await caches.open(REPORTS_CACHE);
    
    try {
        // Try network first for fresh reports
        const networkResponse = await fetch(request);
        
        if (networkResponse.status === 200) {
            // Cache reports for offline access
            cache.put(request, networkResponse.clone());
            
            // Limit cache size (keep last 50 reports)
            limitCacheSize(REPORTS_CACHE, 50);
        }
        
        return networkResponse;
        
    } catch (error) {
        // Fallback to cached version
        const cachedResponse = await cache.match(request);
        if (cachedResponse) {
            // Add offline indicator header
            const response = cachedResponse.clone();
            response.headers.set('X-Served-From', 'cache');
            return response;
        }
        
        return new Response('Report not available offline', {
            status: 503,
            statusText: 'Service Unavailable'
        });
    }
}

/**
 * Determine if URL should use network-first strategy
 */
function isNetworkFirst(url) {
    return NETWORK_FIRST.some(pattern => url.pathname.includes(pattern));
}

/**
 * Determine if URL should use cache-first strategy
 */
function isCacheFirst(url) {
    return CACHE_FIRST.some(pattern => 
        url.href.includes(pattern) || url.pathname.includes(pattern)
    );
}

/**
 * Determine if URL should use stale-while-revalidate strategy
 */
function isStaleWhileRevalidate(url) {
    return STALE_WHILE_REVALIDATE.some(pattern => 
        url.pathname.includes(pattern) || url.pathname.endsWith(pattern)
    );
}

/**
 * Determine if this is a report request
 */
function isReportRequest(url) {
    return url.pathname.includes('/temp/html/') || 
           url.pathname.includes('/api/html_reports/') ||
           url.pathname.includes('report') && url.pathname.includes('.html');
}

/**
 * Limit cache size by removing oldest entries
 */
async function limitCacheSize(cacheName, maxItems) {
    const cache = await caches.open(cacheName);
    const keys = await cache.keys();
    
    if (keys.length > maxItems) {
        // Remove oldest entries (simple FIFO)
        const keysToDelete = keys.slice(0, keys.length - maxItems);
        await Promise.all(
            keysToDelete.map(key => cache.delete(key))
        );
        console.log(`🗑️ Cleaned up ${keysToDelete.length} old cache entries`);
    }
}

/**
 * Background Sync Event
 * Handle background synchronization for offline actions
 */
self.addEventListener('sync', (event) => {
    console.log('🔄 Background sync triggered:', event.tag);
    
    if (event.tag === 'report-analytics') {
        event.waitUntil(syncAnalytics());
    } else if (event.tag === 'report-share') {
        event.waitUntil(syncReportShares());
    }
});

/**
 * Sync analytics data when back online
 */
async function syncAnalytics() {
    try {
        // Get queued analytics from IndexedDB or localStorage
        const queuedData = await getQueuedAnalytics();
        
        if (queuedData.length > 0) {
            console.log(`📊 Syncing ${queuedData.length} analytics events...`);
            
            // Send each queued event
            for (const eventData of queuedData) {
                await fetch('/api/analytics/track', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(eventData)
                });
            }
            
            // Clear queue after successful sync
            await clearAnalyticsQueue();
            console.log('✅ Analytics sync completed');
        }
    } catch (error) {
        console.error('❌ Analytics sync failed:', error);
    }
}

/**
 * Sync report sharing actions when back online
 */
async function syncReportShares() {
    try {
        const queuedShares = await getQueuedShares();
        
        if (queuedShares.length > 0) {
            console.log(`📤 Syncing ${queuedShares.length} share actions...`);
            
            for (const shareData of queuedShares) {
                await fetch('/api/reports/shareReport', {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${shareData.token}`
                    },
                    body: JSON.stringify(shareData)
                });
            }
            
            await clearSharesQueue();
            console.log('✅ Shares sync completed');
        }
    } catch (error) {
        console.error('❌ Shares sync failed:', error);
    }
}

/**
 * Push Event
 * Handle push notifications
 */
self.addEventListener('push', (event) => {
    console.log('📱 Push notification received');
    
    const options = {
        icon: '/assets/reports/mobile/images/icon-192x192.png',
        badge: '/assets/reports/mobile/images/badge-72x72.png',
        vibrate: [100, 50, 100],
        tag: 'modern-agent-notification',
        renotify: true,
        requireInteraction: false,
        actions: [
            {
                action: 'view',
                title: 'View Report',
                icon: '/assets/reports/mobile/images/action-view.png'
            },
            {
                action: 'dismiss',
                title: 'Dismiss',
                icon: '/assets/reports/mobile/images/action-dismiss.png'
            }
        ]
    };
    
    if (event.data) {
        const payload = event.data.json();
        options.title = payload.title || 'Modern Agent';
        options.body = payload.body || 'Your report is ready';
        options.data = payload.data || {};
    } else {
        options.title = 'Modern Agent';
        options.body = 'Your property report is ready to view';
    }
    
    event.waitUntil(
        self.registration.showNotification(options.title, options)
    );
});

/**
 * Notification Click Event
 * Handle notification interactions
 */
self.addEventListener('notificationclick', (event) => {
    console.log('🔔 Notification clicked:', event.action);
    
    event.notification.close();
    
    if (event.action === 'view') {
        // Open the report
        const reportUrl = event.notification.data?.reportUrl || '/';
        event.waitUntil(
            clients.openWindow(reportUrl)
        );
    } else if (event.action === 'dismiss') {
        // Just close the notification
        return;
    } else {
        // Default action - open app
        event.waitUntil(
            clients.openWindow('/')
        );
    }
});

/**
 * Message Event
 * Handle messages from the main thread
 */
self.addEventListener('message', (event) => {
    console.log('💬 Message received:', event.data);
    
    if (event.data && event.data.type) {
        switch (event.data.type) {
            case 'SKIP_WAITING':
                self.skipWaiting();
                break;
                
            case 'CACHE_REPORT':
                cacheReport(event.data.reportUrl);
                break;
                
            case 'CLEAR_CACHE':
                clearAllCaches();
                break;
                
            case 'GET_CACHE_STATUS':
                getCacheStatus().then(status => {
                    event.ports[0]?.postMessage(status);
                });
                break;
        }
    }
});

/**
 * Cache a specific report for offline access
 */
async function cacheReport(reportUrl) {
    try {
        const cache = await caches.open(REPORTS_CACHE);
        await cache.add(reportUrl);
        console.log('✅ Report cached for offline access:', reportUrl);
    } catch (error) {
        console.error('❌ Failed to cache report:', error);
    }
}

/**
 * Clear all caches
 */
async function clearAllCaches() {
    try {
        const cacheNames = await caches.keys();
        await Promise.all(
            cacheNames.map(cacheName => caches.delete(cacheName))
        );
        console.log('🗑️ All caches cleared');
    } catch (error) {
        console.error('❌ Failed to clear caches:', error);
    }
}

/**
 * Get cache status information
 */
async function getCacheStatus() {
    try {
        const cacheNames = await caches.keys();
        const status = {};
        
        for (const cacheName of cacheNames) {
            const cache = await caches.open(cacheName);
            const keys = await cache.keys();
            status[cacheName] = keys.length;
        }
        
        return status;
    } catch (error) {
        console.error('❌ Failed to get cache status:', error);
        return {};
    }
}

/**
 * Placeholder functions for data persistence
 * These would typically use IndexedDB for production
 */
async function getQueuedAnalytics() {
    // Implementation would use IndexedDB
    return JSON.parse(localStorage.getItem('queuedAnalytics') || '[]');
}

async function clearAnalyticsQueue() {
    localStorage.removeItem('queuedAnalytics');
}

async function getQueuedShares() {
    return JSON.parse(localStorage.getItem('queuedShares') || '[]');
}

async function clearSharesQueue() {
    localStorage.removeItem('queuedShares');
}

console.log('🎯 Modern Agent Service Worker loaded successfully');

/**
 * Periodic Background Sync (if supported)
 * Clean up old cache entries periodically
 */
self.addEventListener('periodicsync', (event) => {
    if (event.tag === 'cache-cleanup') {
        event.waitUntil(performCacheCleanup());
    }
});

async function performCacheCleanup() {
    console.log('🧹 Performing periodic cache cleanup...');
    
    // Clean up old reports cache
    await limitCacheSize(REPORTS_CACHE, 25);
    
    // Clean up old dynamic cache
    await limitCacheSize(DYNAMIC_CACHE, 100);
    
    console.log('✅ Cache cleanup completed');
}