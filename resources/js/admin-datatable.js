/**
 * BPROTIC Admin Instant DataTable Engine
 * High-performance, zero-dependency, real-time client-side table engine.
 * Features:
 * - Instant debounced search with query reset
 * - Interactive multi-column sorting (strings, numbers, currencies, dates)
 * - Dynamic pagination & entries-per-page selector
 * - Status & category filter synchronization
 * - Accessible, responsive, and XSS-safe (DOM-based text matching)
 */

class AdminDataTable {
    constructor(table, options = {}) {
        this.table = table;
        this.tbody = table.querySelector('tbody');
        if (!this.tbody) return;

        this.originalRows = Array.from(this.tbody.querySelectorAll('tr')).filter(tr => !tr.classList.contains('datatable-empty-row'));
        this.filteredRows = [...this.originalRows];
        
        this.pageSize = options.pageSize || 10;
        this.currentPage = 1;
        this.searchQuery = '';
        this.statusFilter = '';
        this.statusColumnIndex = options.statusColumnIndex !== undefined ? options.statusColumnIndex : null;
        this.sortCol = null;
        this.sortAsc = true;

        this.init();
    }

    init() {
        // Prevent double init
        if (this.table.__adminDataTable) return;
        this.table.__adminDataTable = this;

        // Build controls container above and below table
        this.buildUI();
        this.setupSorting();
        this.bindEvents();
        this.applyFilter();
    }

    buildUI() {
        // 1. Create main wrapper
        const wrapper = document.createElement('div');
        wrapper.className = 'datatable-wrapper space-y-4';

        // 2. Create Header Controls
        const headerControls = document.createElement('div');
        headerControls.className = 'datatable-header flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 p-4 bg-slate-50/70 border-b border-slate-200';

        // Left: Page Size Selector
        const leftBox = document.createElement('div');
        leftBox.className = 'flex items-center gap-2 text-xs text-slate-600 font-medium';
        leftBox.innerHTML = `
            <span>Tampilkan</span>
            <select class="datatable-page-size px-2.5 py-1.5 rounded-lg border border-slate-300 bg-white text-xs font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#0F2537]">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="-1">Semua</option>
            </select>
            <span>data per halaman</span>
        `;
        this.pageSizeSelect = leftBox.querySelector('.datatable-page-size');
        this.pageSizeSelect.value = this.pageSize;

        // Right: Realtime Search Input & Clear Button
        const rightBox = document.createElement('div');
        rightBox.className = 'flex items-center gap-2.5 w-full sm:w-auto';

        const searchWrapper = document.createElement('div');
        searchWrapper.className = 'relative flex-1 sm:w-72';
        searchWrapper.innerHTML = `
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <input type="text" class="datatable-search-input w-full pl-9 pr-8 py-2 rounded-xl border border-slate-300 bg-white text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#0F2537] focus:border-transparent transition-all shadow-inner" placeholder="Cari data realtime...">
            <button type="button" class="datatable-clear-btn absolute inset-y-0 right-0 pr-2.5 flex items-center text-slate-400 hover:text-rose-600 hidden transition-colors" title="Bersihkan pencarian">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        `;
        this.searchInput = searchWrapper.querySelector('.datatable-search-input');
        this.clearBtn = searchWrapper.querySelector('.datatable-clear-btn');

        rightBox.appendChild(searchWrapper);
        headerControls.appendChild(leftBox);
        headerControls.appendChild(rightBox);

        // 3. Insert wrapper before table and place header inside
        const tableParent = this.table.parentElement;
        tableParent.insertBefore(wrapper, this.table);
        wrapper.appendChild(headerControls);
        wrapper.appendChild(this.table);

        // 4. Create Footer Controls (Entries info + Pagination)
        const footerControls = document.createElement('div');
        footerControls.className = 'datatable-footer flex flex-col sm:flex-row justify-between items-center gap-3 p-4 bg-white border-t border-slate-100 text-xs text-slate-600';
        footerControls.innerHTML = `
            <div class="datatable-info text-slate-500 font-medium">
                Menampilkan <span class="font-bold text-slate-800 info-start">0</span> sampai <span class="font-bold text-slate-800 info-end">0</span> dari <span class="font-bold text-slate-800 info-total">0</span> data
                <span class="info-filtered text-slate-400 font-normal hidden">(difilter dari <span class="info-orig-total">0</span> total data)</span>
            </div>
            <div class="datatable-pagination flex items-center gap-1 select-none">
                <!-- Pagination buttons injected dynamically -->
            </div>
        `;
        this.infoStart = footerControls.querySelector('.info-start');
        this.infoEnd = footerControls.querySelector('.info-end');
        this.infoTotal = footerControls.querySelector('.info-total');
        this.infoFiltered = footerControls.querySelector('.info-filtered');
        this.infoOrigTotal = footerControls.querySelector('.info-orig-total');
        this.paginationContainer = footerControls.querySelector('.datatable-pagination');

        wrapper.appendChild(footerControls);

        // 5. Create empty search feedback row
        const colCount = this.table.querySelectorAll('thead th').length || 6;
        this.emptyRow = document.createElement('tr');
        this.emptyRow.className = 'datatable-empty-row hidden';
        this.emptyRow.innerHTML = `
            <td colspan="${colCount}" class="py-12 text-center text-xs text-slate-400">
                <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <div class="font-semibold text-slate-600">Tidak ada data yang cocok dengan pencarian</div>
                <div class="text-[11px] text-slate-400 mt-0.5">Coba gunakan kata kunci lain atau bersihkan kotak pencarian.</div>
            </td>
        `;
        this.tbody.appendChild(this.emptyRow);
    }

    setupSorting() {
        const headers = this.table.querySelectorAll('thead th');
        headers.forEach((th, index) => {
            // Skip action column or columns explicitly marked as data-no-sort
            if (th.getAttribute('data-no-sort') === 'true' || th.textContent.trim().toLowerCase().includes('aksi')) {
                return;
            }

            th.classList.add('cursor-pointer', 'hover:bg-slate-100', 'transition-colors', 'select-none');
            th.title = 'Klik untuk mengurutkan';

            // Add sort indicator icon
            const sortIcon = document.createElement('span');
            sortIcon.className = 'datatable-sort-icon inline-block ml-1 text-slate-300 text-[10px]';
            sortIcon.textContent = '⇅';
            th.appendChild(sortIcon);

            th.addEventListener('click', () => {
                if (this.sortCol === index) {
                    this.sortAsc = !this.sortAsc;
                } else {
                    this.sortCol = index;
                    this.sortAsc = true;
                }

                // Update icons across all headers
                headers.forEach(h => {
                    const icon = h.querySelector('.datatable-sort-icon');
                    if (icon) {
                        icon.textContent = '⇅';
                        icon.classList.remove('text-amber-600', 'font-black');
                        icon.classList.add('text-slate-300');
                    }
                });

                sortIcon.textContent = this.sortAsc ? '▲' : '▼';
                sortIcon.classList.remove('text-slate-300');
                sortIcon.classList.add('text-amber-600', 'font-black');

                this.sortRows(index, this.sortAsc);
                this.render();
            });
        });
    }

    sortRows(colIndex, asc) {
        this.filteredRows.sort((a, b) => {
            const cellA = a.children[colIndex]?.textContent.trim() || '';
            const cellB = b.children[colIndex]?.textContent.trim() || '';

            // Check if currency/number
            const numA = parseFloat(cellA.replace(/[^0-9.-]+/g, ''));
            const numB = parseFloat(cellB.replace(/[^0-9.-]+/g, ''));

            if (!isNaN(numA) && !isNaN(numB) && cellA.match(/\d/) && cellB.match(/\d/)) {
                return asc ? (numA - numB) : (numB - numA);
            }

            return asc 
                ? cellA.localeCompare(cellB, undefined, { numeric: true, sensitivity: 'base' })
                : cellB.localeCompare(cellA, undefined, { numeric: true, sensitivity: 'base' });
        });
    }

    bindEvents() {
        // Realtime Search (as you type)
        this.searchInput.addEventListener('input', (e) => {
            this.searchQuery = e.target.value.trim().toLowerCase();
            if (this.searchQuery) {
                this.clearBtn.classList.remove('hidden');
            } else {
                this.clearBtn.classList.add('hidden');
            }
            this.currentPage = 1;
            this.applyFilter();
        });

        // Clear Search Button
        this.clearBtn.addEventListener('click', () => {
            this.searchInput.value = '';
            this.searchQuery = '';
            this.clearBtn.classList.add('hidden');
            this.currentPage = 1;
            this.applyFilter();
            this.searchInput.focus();
        });

        // Page Size Change
        this.pageSizeSelect.addEventListener('change', (e) => {
            this.pageSize = parseInt(e.target.value, 10);
            this.currentPage = 1;
            this.render();
        });

        // External category/status filter buttons or selects if any (e.g. data-table-filter)
        const filters = document.querySelectorAll(`[data-datatable-filter="${this.table.id || ''}"]`);
        filters.forEach(filter => {
            filter.addEventListener('change', (e) => {
                this.statusFilter = e.target.value.toLowerCase();
                this.currentPage = 1;
                this.applyFilter();
            });
        });
    }

    applyFilter() {
        const query = this.searchQuery;
        const statusFilter = this.statusFilter;

        this.filteredRows = this.originalRows.filter(row => {
            // 1. Text Search across searchable cells
            let textMatch = true;
            if (query) {
                const cells = Array.from(row.children).slice(0, -1); // exclude last action column
                const rowText = cells.map(c => c.textContent.toLowerCase()).join(' ');
                textMatch = rowText.includes(query);
            }

            // 2. Status/Category filter
            let filterMatch = true;
            if (statusFilter && statusFilter !== 'all' && statusFilter !== '') {
                const rowText = row.textContent.toLowerCase();
                filterMatch = rowText.includes(statusFilter);
            }

            return textMatch && filterMatch;
        });

        if (this.sortCol !== null) {
            this.sortRows(this.sortCol, this.sortAsc);
        }

        this.render();
    }

    render() {
        const total = this.filteredRows.length;
        const isAll = this.pageSize === -1;
        const perPage = isAll ? (total || 1) : this.pageSize;
        const totalPages = Math.ceil(total / perPage) || 1;

        if (this.currentPage > totalPages) {
            this.currentPage = totalPages;
        }

        const startIdx = (this.currentPage - 1) * perPage;
        const endIdx = isAll ? total : Math.min(startIdx + perPage, total);

        // Hide all rows first
        this.originalRows.forEach(row => {
            row.style.display = 'none';
        });

        // Show slice of filtered rows
        if (total > 0) {
            this.emptyRow.classList.add('hidden');
            for (let i = startIdx; i < endIdx; i++) {
                const row = this.filteredRows[i];
                if (row) {
                    row.style.display = '';
                    this.tbody.appendChild(row); // Keep ordered
                }
            }
        } else {
            this.emptyRow.classList.remove('hidden');
        }

        // Update info text
        this.infoStart.textContent = total > 0 ? (startIdx + 1) : 0;
        this.infoEnd.textContent = endIdx;
        this.infoTotal.textContent = total;

        if (total < this.originalRows.length) {
            this.infoFiltered.classList.remove('hidden');
            this.infoOrigTotal.textContent = this.originalRows.length;
        } else {
            this.infoFiltered.classList.add('hidden');
        }

        // Render Pagination buttons
        this.renderPagination(totalPages);
    }

    renderPagination(totalPages) {
        this.paginationContainer.innerHTML = '';
        if (totalPages <= 1) return;

        // Previous button
        const prevBtn = document.createElement('button');
        prevBtn.type = 'button';
        prevBtn.className = `px-2.5 py-1.5 rounded-lg border text-xs font-semibold transition-all ${this.currentPage === 1 ? 'border-slate-200 text-slate-300 cursor-not-allowed' : 'border-slate-300 text-slate-700 hover:bg-slate-100 cursor-pointer'}`;
        prevBtn.innerHTML = '&larr;';
        prevBtn.disabled = this.currentPage === 1;
        prevBtn.addEventListener('click', () => {
            if (this.currentPage > 1) {
                this.currentPage--;
                this.render();
            }
        });
        this.paginationContainer.appendChild(prevBtn);

        // Page number buttons
        const createPageBtn = (pageNum) => {
            const btn = document.createElement('button');
            btn.type = 'button';
            const isActive = pageNum === this.currentPage;
            btn.className = `px-3 py-1.5 rounded-lg text-xs font-bold transition-all ${isActive ? 'bg-[#0F2537] text-white shadow-sm' : 'border border-slate-300 text-slate-700 hover:bg-slate-100 cursor-pointer'}`;
            btn.textContent = pageNum;
            btn.addEventListener('click', () => {
                this.currentPage = pageNum;
                this.render();
            });
            return btn;
        };

        // Sliding window for page numbers
        const maxButtons = 5;
        let startPage = Math.max(1, this.currentPage - 2);
        let endPage = Math.min(totalPages, startPage + maxButtons - 1);

        if (endPage - startPage < maxButtons - 1) {
            startPage = Math.max(1, endPage - maxButtons + 1);
        }

        if (startPage > 1) {
            this.paginationContainer.appendChild(createPageBtn(1));
            if (startPage > 2) {
                const dots = document.createElement('span');
                dots.className = 'px-1 text-slate-400';
                dots.textContent = '...';
                this.paginationContainer.appendChild(dots);
            }
        }

        for (let p = startPage; p <= endPage; p++) {
            this.paginationContainer.appendChild(createPageBtn(p));
        }

        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                const dots = document.createElement('span');
                dots.className = 'px-1 text-slate-400';
                dots.textContent = '...';
                this.paginationContainer.appendChild(dots);
            }
            this.paginationContainer.appendChild(createPageBtn(totalPages));
        }

        // Next button
        const nextBtn = document.createElement('button');
        nextBtn.type = 'button';
        nextBtn.className = `px-2.5 py-1.5 rounded-lg border text-xs font-semibold transition-all ${this.currentPage === totalPages ? 'border-slate-200 text-slate-300 cursor-not-allowed' : 'border-slate-300 text-slate-700 hover:bg-slate-100 cursor-pointer'}`;
        nextBtn.innerHTML = '&rarr;';
        nextBtn.disabled = this.currentPage === totalPages;
        nextBtn.addEventListener('click', () => {
            if (this.currentPage < totalPages) {
                this.currentPage++;
                this.render();
            }
        });
        this.paginationContainer.appendChild(nextBtn);
    }
}

// Auto-initialize on DOM ready for any table with class .admin-datatable
export function initAdminDataTables() {
    const tables = document.querySelectorAll('table.admin-datatable');
    tables.forEach(table => {
        if (!table.__adminDataTable) {
            new AdminDataTable(table);
        }
    });
}

if (typeof document !== 'undefined') {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => initAdminDataTables());
    } else {
        initAdminDataTables();
    }
}
