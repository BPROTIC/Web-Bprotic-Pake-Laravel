/**
 * BPROTIC Interactive Galaxy & Space Starfield Engine
 * Creates responsive cosmic particle constellations that react to mouse hover/motion.
 * Supports:
 * 1. Global background canvas (#galaxy-layout-canvas) across the entire public layout.
 * 2. Dedicated container sections ([data-galaxy="true"], [data-orbital="true"]).
 */

class GalaxyCanvas {
    constructor(target, options = {}) {
        this.isCanvasTarget = target instanceof HTMLCanvasElement;
        this.container = this.isCanvasTarget ? target.parentElement : target;
        this.isGlobal = options.isGlobal !== undefined ? options.isGlobal : this.isCanvasTarget;
        this.isDark = options.isDark !== undefined ? options.isDark : !this.isGlobal;

        if (this.isCanvasTarget) {
            this.canvas = target;
        } else {
            this.canvas = document.createElement('canvas');
        }

        this.ctx = this.canvas.getContext('2d');
        this.stars = [];
        this.meteors = [];
        this.mouse = { x: -9999, y: -9999, active: false, radius: this.isGlobal ? 160 : 130 };
        this.animationId = null;
        this.isVisible = true;
        this.lastMeteorTime = Date.now();

        this.init();
    }

    init() {
        if (!this.isCanvasTarget) {
            // Ensure container styling allows absolute canvas overlay
            const containerStyle = window.getComputedStyle(this.container);
            if (containerStyle.position === 'static') {
                this.container.style.position = 'relative';
            }
            this.container.style.overflow = 'hidden';

            // Setup canvas
            this.canvas.className = 'galaxy-canvas absolute inset-0 w-full h-full pointer-events-none z-0';
            this.canvas.style.position = 'absolute';
            this.canvas.style.top = '0';
            this.canvas.style.left = '0';
            this.canvas.style.width = '100%';
            this.canvas.style.height = '100%';
            this.canvas.style.pointerEvents = 'none';

            // Prepend canvas as the first child of the container
            this.container.insertBefore(this.canvas, this.container.firstChild);
        }

        this.resize();
        this.initStars();
        this.bindEvents();
        this.start();
    }

    resize() {
        if (this.isGlobal) {
            this.width = window.innerWidth;
            this.height = window.innerHeight;
        } else {
            const rect = this.container.getBoundingClientRect();
            this.width = rect.width;
            this.height = rect.height;
        }

        const dpr = Math.min(window.devicePixelRatio || 1, 2);
        this.canvas.width = this.width * dpr;
        this.canvas.height = this.height * dpr;
        this.ctx.setTransform(1, 0, 0, 1, 0, 0);
        this.ctx.scale(dpr, dpr);
    }

    initStars() {
        this.stars = [];

        let count;
        if (this.isGlobal) {
            // Moderate count for smooth global background across the whole window
            count = Math.min(Math.max(Math.floor((this.width * this.height) / 22000), 35), 65);
        } else {
            // Container section star density
            count = Math.min(Math.max(Math.floor((this.width * this.height) / 9000), 40), 120);
        }

        let colors;
        if (this.isDark) {
            // Dark mode palette: White starlight, warm amber-gold (BPROTIC), and electric cyan
            colors = [
                { r: 255, g: 255, b: 255 }, // White Starlight
                { r: 251, g: 191, b: 36 },  // Amber-400
                { r: 245, g: 158, b: 11 },  // Amber-500
                { r: 56,  g: 189, b: 248 }, // Cyan-400
            ];
        } else {
            // Light background palette (harmonious on academic cream #FAF6ED):
            // Warm Amber Gold, BPROTIC Navy, and Subtle Indigo
            colors = [
                { r: 217, g: 119, b: 6 },   // Amber-600 (Academic Gold)
                { r: 180, g: 83,  b: 9 },   // Amber-700
                { r: 15,  g: 37,  b: 55 },  // BPROTIC Navy (#0F2537)
                { r: 59,  g: 130, b: 246 }, // Bright Indigo
                { r: 120, g: 135, b: 155 }, // Soft Slate
            ];
        }

        for (let i = 0; i < count; i++) {
            const color = colors[Math.floor(Math.random() * colors.length)];
            const radius = Math.random() < 0.15 
                ? (Math.random() * 1.5 + (this.isDark ? 2.0 : 1.6))
                : (Math.random() * 1.1 + (this.isDark ? 0.8 : 0.7));

            const baseAlpha = this.isDark
                ? (Math.random() * 0.5 + 0.4)
                : (Math.random() * 0.35 + 0.25);

            this.stars.push({
                x: Math.random() * this.width,
                y: Math.random() * this.height,
                vx: (Math.random() - 0.5) * 0.35,
                vy: (Math.random() - 0.5) * 0.35,
                radius: radius,
                color: color,
                baseAlpha: baseAlpha,
                alpha: baseAlpha,
                twinkleSpeed: Math.random() * 0.02 + 0.008,
                twinklePhase: Math.random() * Math.PI * 2,
                hasHalo: this.isDark && radius > 2.0,
            });
        }
    }

    bindEvents() {
        if (this.isGlobal) {
            // Global mouse tracking across the entire viewport
            const onGlobalMove = (e) => {
                const clientX = e.touches ? e.touches[0].clientX : e.clientX;
                const clientY = e.touches ? e.touches[0].clientY : e.clientY;
                this.mouse.x = clientX;
                this.mouse.y = clientY;
                this.mouse.active = true;
            };

            const onGlobalLeave = () => {
                this.mouse.x = -9999;
                this.mouse.y = -9999;
                this.mouse.active = false;
            };

            window.addEventListener('mousemove', onGlobalMove, { passive: true });
            window.addEventListener('mouseleave', onGlobalLeave, { passive: true });
            window.addEventListener('touchmove', onGlobalMove, { passive: true });
            window.addEventListener('touchend', onGlobalLeave, { passive: true });

            // Window resize
            window.addEventListener('resize', () => {
                this.resize();
                if (this.stars.length === 0) this.initStars();
            });

            // Pause when document hidden (battery & CPU saving)
            document.addEventListener('visibilitychange', () => {
                this.isVisible = !document.hidden;
                if (this.isVisible && !this.animationId) {
                    this.start();
                }
            });
        } else {
            // Container-specific mouse tracking
            const onPointerMove = (e) => {
                const rect = this.container.getBoundingClientRect();
                const clientX = e.touches ? e.touches[0].clientX : e.clientX;
                const clientY = e.touches ? e.touches[0].clientY : e.clientY;

                this.mouse.x = clientX - rect.left;
                this.mouse.y = clientY - rect.top;
                this.mouse.active = true;
            };

            const onPointerLeave = () => {
                this.mouse.x = -9999;
                this.mouse.y = -9999;
                this.mouse.active = false;
            };

            this.container.addEventListener('mousemove', onPointerMove, { passive: true });
            this.container.addEventListener('mouseleave', onPointerLeave, { passive: true });
            this.container.addEventListener('touchmove', onPointerMove, { passive: true });
            this.container.addEventListener('touchend', onPointerLeave, { passive: true });

            // Resize observer for container
            this.resizeObserver = new ResizeObserver(() => {
                this.resize();
                if (this.stars.length === 0) this.initStars();
            });
            this.resizeObserver.observe(this.container);

            // Visibility observer (pause when scrolled out of viewport)
            this.intersectionObserver = new IntersectionObserver(([entry]) => {
                this.isVisible = entry.isIntersecting;
                if (this.isVisible && !this.animationId) {
                    this.start();
                }
            });
            this.intersectionObserver.observe(this.container);
        }
    }

    spawnMeteor() {
        if (!this.isDark) return; // Only spawn shooting stars in dark cosmic spaces

        const now = Date.now();
        if (now - this.lastMeteorTime > 4500 && Math.random() < 0.4) {
            this.lastMeteorTime = now;
            const startX = Math.random() * (this.width * 0.8) + this.width * 0.1;
            const startY = Math.random() * (this.height * 0.3);
            const angle = (Math.PI / 4) + (Math.random() - 0.5) * 0.2;
            const speed = Math.random() * 7 + 8;

            this.meteors.push({
                x: startX,
                y: startY,
                vx: Math.cos(angle) * speed,
                vy: Math.sin(angle) * speed,
                length: Math.random() * 60 + 60,
                opacity: 0.9,
                color: Math.random() > 0.4 ? '251, 191, 36' : '255, 255, 255',
            });
        }
    }

    render() {
        if (!this.isVisible) {
            this.animationId = null;
            return;
        }

        const ctx = this.ctx;
        ctx.clearRect(0, 0, this.width, this.height);

        // 1. Update and draw stars
        const maxLinkDist = this.isGlobal ? 110 : 95;
        const maxMouseDist = this.mouse.radius;

        for (let i = 0; i < this.stars.length; i++) {
            const star = this.stars[i];

            // Natural cosmic drift
            star.x += star.vx;
            star.y += star.vy;

            // Wrap around boundaries smoothly
            if (star.x < 0) star.x = this.width;
            if (star.x > this.width) star.x = 0;
            if (star.y < 0) star.y = this.height;
            if (star.y > this.height) star.y = 0;

            // Gentle twinkle oscillation
            star.twinklePhase += star.twinkleSpeed;
            const twinkle = Math.sin(star.twinklePhase) * 0.2;
            star.alpha = Math.max(0.1, Math.min(1, star.baseAlpha + twinkle));

            // Reactive Mouse Interaction: Stars move away & connect with cursor
            if (this.mouse.active) {
                const dx = star.x - this.mouse.x;
                const dy = star.y - this.mouse.y;
                const dist = Math.hypot(dx, dy);

                if (dist < maxMouseDist && dist > 0) {
                    const force = (1 - (dist / maxMouseDist)) * (this.isGlobal ? 2.5 : 3.8);
                    const angle = Math.atan2(dy, dx);
                    star.x += Math.cos(angle) * force;
                    star.y += Math.sin(angle) * force;

                    // Draw interactive beam from cursor to star
                    const beamAlpha = (1 - (dist / maxMouseDist)) * (this.isDark ? 0.5 : 0.25);
                    ctx.beginPath();
                    ctx.moveTo(this.mouse.x, this.mouse.y);
                    ctx.lineTo(star.x, star.y);
                    ctx.strokeStyle = `rgba(${star.color.r}, ${star.color.g}, ${star.color.b}, ${beamAlpha})`;
                    ctx.lineWidth = this.isDark ? 0.9 : 0.7;
                    ctx.stroke();

                    // Boost star glow when interacting
                    star.alpha = Math.min(1, star.alpha + 0.3);
                }
            }

            // Draw glowing halo for larger stars
            if (star.hasHalo) {
                const gradient = ctx.createRadialGradient(
                    star.x, star.y, 0,
                    star.x, star.y, star.radius * 3.2
                );
                gradient.addColorStop(0, `rgba(${star.color.r}, ${star.color.g}, ${star.color.b}, ${star.alpha * 0.8})`);
                gradient.addColorStop(0.5, `rgba(${star.color.r}, ${star.color.g}, ${star.color.b}, ${star.alpha * 0.25})`);
                gradient.addColorStop(1, 'rgba(0, 0, 0, 0)');

                ctx.beginPath();
                ctx.arc(star.x, star.y, star.radius * 3.2, 0, Math.PI * 2);
                ctx.fillStyle = gradient;
                ctx.fill();
            }

            // Draw Star Core
            ctx.beginPath();
            ctx.arc(star.x, star.y, star.radius, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(${star.color.r}, ${star.color.g}, ${star.color.b}, ${star.alpha})`;
            ctx.fill();

            // Connect nearby stars with constellation lines
            for (let j = i + 1; j < this.stars.length; j++) {
                const other = this.stars[j];
                const dStarX = star.x - other.x;
                const dStarY = star.y - other.y;
                const starDist = Math.hypot(dStarX, dStarY);

                if (starDist < maxLinkDist) {
                    const lineFactor = 1 - (starDist / maxLinkDist);
                    const lineAlpha = this.isDark ? (lineFactor * 0.16) : (lineFactor * 0.12);
                    
                    ctx.beginPath();
                    ctx.moveTo(star.x, star.y);
                    ctx.lineTo(other.x, other.y);
                    if (this.isDark) {
                        ctx.strokeStyle = `rgba(200, 220, 255, ${lineAlpha})`;
                    } else {
                        ctx.strokeStyle = `rgba(180, 130, 60, ${lineAlpha})`;
                    }
                    ctx.lineWidth = 0.6;
                    ctx.stroke();
                }
            }
        }

        // 2. Meteors / Shooting stars (on dark sections)
        this.spawnMeteor();
        for (let m = this.meteors.length - 1; m >= 0; m--) {
            const meteor = this.meteors[m];
            meteor.x += meteor.vx;
            meteor.y += meteor.vy;
            meteor.opacity -= 0.02;

            if (meteor.opacity <= 0 || meteor.x > this.width + 100 || meteor.y > this.height + 100) {
                this.meteors.splice(m, 1);
                continue;
            }

            const tailX = meteor.x - (meteor.vx / Math.hypot(meteor.vx, meteor.vy)) * meteor.length;
            const tailY = meteor.y - (meteor.vy / Math.hypot(meteor.vx, meteor.vy)) * meteor.length;

            const grad = ctx.createLinearGradient(tailX, tailY, meteor.x, meteor.y);
            grad.addColorStop(0, `rgba(${meteor.color}, 0)`);
            grad.addColorStop(1, `rgba(${meteor.color}, ${meteor.opacity})`);

            ctx.beginPath();
            ctx.moveTo(tailX, tailY);
            ctx.lineTo(meteor.x, meteor.y);
            ctx.strokeStyle = grad;
            ctx.lineWidth = 1.6;
            ctx.lineCap = 'round';
            ctx.stroke();
        }

        this.animationId = requestAnimationFrame(() => this.render());
    }

    start() {
        if (!this.animationId) {
            this.animationId = requestAnimationFrame(() => this.render());
        }
    }
}

// Auto-initialize galaxy canvas
export function initGalaxyCanvases() {
    // 1. Global background canvas across the entire public layout
    const globalCanvas = document.getElementById('galaxy-layout-canvas');
    if (globalCanvas && !globalCanvas.__galaxyInstance) {
        globalCanvas.__galaxyInstance = new GalaxyCanvas(globalCanvas, { isGlobal: true, isDark: false });
    }

    // 2. Sections/Containers marked with data-galaxy="true" or data-orbital="true"
    const containers = document.querySelectorAll('[data-galaxy="true"], [data-orbital="true"], .galaxy-canvas-container');
    containers.forEach((container) => {
        if (!container.__galaxyInstance && container !== globalCanvas) {
            container.__galaxyInstance = new GalaxyCanvas(container, { isGlobal: false, isDark: true });
        }
    });
}

// Execute on DOMContentLoaded
if (typeof document !== 'undefined') {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => initGalaxyCanvases());
    } else {
        initGalaxyCanvases();
    }
}
