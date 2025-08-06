document.addEventListener("DOMContentLoaded", function () {
    // --- INISIALISASI PETA ---
    // Koordinat yang diperbarui untuk Polres Konawe Selatan di Lerepako, Laeya
    var polresKonselCoords = [-4.308859, 122.448131];
    var map = L.map("map").setView(polresKonselCoords, 5);

    // Tile Layer dengan multiple providers
    var osmLayer = L.tileLayer(
        "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
        {
            attribution: "© OpenStreetMap contributors",
        }
    );

    var satelliteLayer = L.tileLayer(
        "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
        {
            attribution: "Tiles &copy; Esri",
        }
    );

    osmLayer.addTo(map);

    // Layer control
    var baseMaps = {
        "Peta Standar": osmLayer,
        Satelit: satelliteLayer,
    };
    L.control.layers(baseMaps).addTo(map);

    // Custom marker icon
    var customIcon = L.divIcon({
        html: '<i class="fas fa-map-marker-alt text-red-500 text-2xl"></i>',
        iconSize: [30, 30],
        className: "custom-div-icon",
    });

    var marker = L.marker(polresKonselCoords, {
        draggable: true,
        icon: customIcon,
    }).addTo(map);

    marker
        .bindPopup(
            "<b>Polres Konawe Selatan</b><br>Lerepako, Laeya, Konawe Selatan"
        )
        .openPopup();

    // Set koordinat awal
    updateCoordinates(polresKonselCoords[0], polresKonselCoords[1]);

    // --- FUNGSI UTILITY ---
    function updateCoordinates(lat, lon) {
        document.getElementById("latitude").value = lat;
        document.getElementById("longitude").value = lon;
        document.getElementById("coordDisplay").textContent = `${lat.toFixed(
            6
        )}, ${lon.toFixed(6)}`;
    }

    function updatePosition(lat, lon, zoomLevel = 17, popupText = null) {
        var newLatLng = new L.LatLng(lat, lon);
        map.setView(newLatLng, zoomLevel);
        marker.setLatLng(newLatLng);
        updateCoordinates(lat, lon);

        if (popupText) {
            marker.bindPopup(popupText).openPopup();
        }
    }

    function setButtonLoading(button, loading) {
        if (loading) {
            button.classList.add("btn-loading");
            button.disabled = true;
        } else {
            button.classList.remove("btn-loading");
            button.disabled = false;
        }
    }

    // --- PENCARIAN LOKASI ---
    var searchTimeout;
    var searchResults = document.getElementById("searchResults");

    document
        .getElementById("lokasi_pencarian")
        .addEventListener("input", function () {
            var query = this.value.trim();

            clearTimeout(searchTimeout);

            if (query.length < 3) {
                searchResults.style.display = "none";
                return;
            }

            searchTimeout = setTimeout(() => {
                searchLocation(query, true);
            }, 500);
        });

    function searchLocation(query, isAutocomplete = false) {
        if (!query) {
            if (!isAutocomplete) alert("Mohon masukkan nama lokasi.");
            return;
        }

        var apiUrl = `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(
            query + " Konawe Selatan Sulawesi Tenggara"
        )}&format=json&limit=${
            isAutocomplete ? 5 : 1
        }&countrycodes=id&addressdetails=1`;

        fetch(apiUrl)
            .then((response) => response.json())
            .then((data) => {
                if (isAutocomplete) {
                    displaySearchResults(data);
                } else {
                    if (data.length > 0) {
                        var result = data[0];
                        updatePosition(
                            parseFloat(result.lat),
                            parseFloat(result.lon),
                            17,
                            `<b>${result.display_name}</b>`
                        );
                    } else {
                        alert(
                            "Lokasi tidak ditemukan. Coba gunakan kata kunci yang lebih spesifik."
                        );
                    }
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                if (!isAutocomplete) {
                    alert(
                        "Terjadi kesalahan saat mencari lokasi. Silakan coba lagi."
                    );
                }
            });
    }

    function displaySearchResults(results) {
        searchResults.innerHTML = "";

        if (results.length === 0) {
            searchResults.style.display = "none";
            return;
        }

        results.forEach((result) => {
            var item = document.createElement("div");
            item.className = "search-result-item";
            item.innerHTML = `
                        <div class="font-medium">${
                            result.name || "Lokasi"
                        }</div>
                        <div class="text-sm text-gray-600">${
                            result.display_name
                        }</div>
                    `;

            item.addEventListener("click", function () {
                document.getElementById("lokasi_pencarian").value =
                    result.display_name;
                updatePosition(
                    parseFloat(result.lat),
                    parseFloat(result.lon),
                    17,
                    `<b>${result.display_name}</b>`
                );
                searchResults.style.display = "none";
            });

            searchResults.appendChild(item);
        });

        searchResults.style.display = "block";
    }

    // Hide search results when clicking outside
    document.addEventListener("click", function (e) {
        if (!e.target.closest(".search-group")) {
            searchResults.style.display = "none";
        }
    });

    // --- EVENT LISTENERS ---
    document
        .getElementById("tombol_cari")
        .addEventListener("click", function () {
            var query = document
                .getElementById("lokasi_pencarian")
                .value.trim();
            setButtonLoading(this, true);

            setTimeout(() => {
                searchLocation(query, false);
                setButtonLoading(this, false);
            }, 500);
        });

    document
        .getElementById("tombol_lokasi_saya")
        .addEventListener("click", function () {
            if (!navigator.geolocation) {
                alert("Browser Anda tidak mendukung Geolocation.");
                return;
            }

            setButtonLoading(this, true);

            navigator.geolocation.getCurrentPosition(
                function (position) {
                    updatePosition(
                        position.coords.latitude,
                        position.coords.longitude,
                        17,
                        "<b>Lokasi Anda Saat Ini</b>"
                    );
                    setButtonLoading(
                        document.getElementById("tombol_lokasi_saya"),
                        false
                    );
                },
                function (error) {
                    var errorMsg = "Gagal mendapatkan lokasi. ";
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            errorMsg += "Izinkan akses lokasi pada browser.";
                            break;
                        case error.POSITION_UNAVAILABLE:
                            errorMsg += "Informasi lokasi tidak tersedia.";
                            break;
                        case error.TIMEOUT:
                            errorMsg += "Waktu habis saat mengambil lokasi.";
                            break;
                    }
                    alert(errorMsg);
                    setButtonLoading(
                        document.getElementById("tombol_lokasi_saya"),
                        false
                    );
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 300000,
                }
            );
        });

    // Marker drag event
    marker.on("dragend", function (event) {
        var position = marker.getLatLng();
        updateCoordinates(position.lat, position.lng);

        // Reverse geocoding
        var reverseUrl = `https://nominatim.openstreetmap.org/reverse?lat=${position.lat}&lon=${position.lng}&format=json&addressdetails=1`;
        fetch(reverseUrl)
            .then((response) => response.json())
            .then((data) => {
                if (data.display_name) {
                    marker
                        .bindPopup(
                            `<b>Lokasi Dipilih</b><br>${data.display_name}`
                        )
                        .openPopup();
                }
            })
            .catch(() => {
                marker.bindPopup(
                    `<b>Lokasi Dipilih</b><br>Lat: ${position.lat.toFixed(
                        6
                    )}, Lon: ${position.lng.toFixed(6)}`
                );
            });
    });

    // Copy coordinates
    document
        .getElementById("copyCoords")
        .addEventListener("click", function () {
            var coords = document.getElementById("coordDisplay").textContent;
            navigator.clipboard.writeText(coords).then(() => {
                this.innerHTML = '<i class="fas fa-check"></i> Disalin';
                setTimeout(() => {
                    this.innerHTML = '<i class="fas fa-copy"></i> Salin';
                }, 2000);
            });
        });

    // --- FORM ENHANCEMENTS ---

    // Character counter
    var isiTextarea = document.getElementById("isi");
    var charCount = document.getElementById("charCount");

    function updateCharCount() {
        charCount.textContent = isiTextarea.value.length;
    }

    isiTextarea.addEventListener("input", updateCharCount);
    updateCharCount();

    // Form validation
    document
        .getElementById("pengaduanForm")
        .addEventListener("submit", function (e) {
            var lat = document.getElementById("latitude").value;
            var lon = document.getElementById("longitude").value;

            if (!lat || !lon || lat == "0" || lon == "0") {
                e.preventDefault();
                alert("Harap pilih lokasi kejadian pada peta terlebih dahulu.");
                return false;
            }

            // Show loading on submit button
            var submitBtn = document.getElementById("submitBtn");
            setButtonLoading(submitBtn, true);
            submitBtn.innerHTML =
                '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
        });

    // Auto-save draft (using sessionStorage)
    function saveDraft() {
        var formData = {
            judul: document.getElementById("judul").value,
            kategori_id: document.getElementById("kategori_id").value,
            isi: document.getElementById("isi").value,
            latitude: document.getElementById("latitude").value,
            longitude: document.getElementById("longitude").value,
        };
        sessionStorage.setItem("pengaduan_draft", JSON.stringify(formData));
    }

    function loadDraft() {
        var draft = sessionStorage.getItem("pengaduan_draft");
        if (draft) {
            var formData = JSON.parse(draft);
            document.getElementById("judul").value = formData.judul || "";
            document.getElementById("kategori_id").value =
                formData.kategori_id || "";
            document.getElementById("isi").value = formData.isi || "";

            if (formData.latitude && formData.longitude) {
                updatePosition(
                    parseFloat(formData.latitude),
                    parseFloat(formData.longitude)
                );
            }
            updateCharCount();
        }
    }

    // Load draft on page load
    loadDraft();

    // Save draft every 30 seconds
    setInterval(saveDraft, 30000);

    // Save draft on form input changes
    ["judul", "kategori_id", "isi"].forEach(function (id) {
        document.getElementById(id).addEventListener("input", saveDraft);
    });

    // Clear draft on successful submit
    document
        .getElementById("pengaduanForm")
        .addEventListener("submit", function () {
            setTimeout(function () {
                sessionStorage.removeItem("pengaduan_draft");
            }, 1000);
        });
});

// --- IMAGE PREVIEW FUNCTIONS ---
function previewImage(event) {
    var file = event.target.files[0];
    var preview = document.getElementById("preview");
    var previewContainer = document.getElementById("imagePreview");

    if (file) {
        // Validate file size (2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert("Ukuran file terlalu besar. Maksimal 2MB.");
            event.target.value = "";
            return;
        }

        // Validate file type
        if (!file.type.startsWith("image/")) {
            alert("File harus berupa gambar.");
            event.target.value = "";
            return;
        }

        var reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            previewContainer.classList.remove("hidden");
        };
        reader.readAsDataURL(file);
    }
}

function removeImage() {
    document.getElementById("foto").value = "";
    document.getElementById("imagePreview").classList.add("hidden");
    document.getElementById("preview").src = "";
}

// --- KEYBOARD SHORTCUTS ---
document.addEventListener("keydown", function (e) {
    // Ctrl/Cmd + Enter to submit form
    if ((e.ctrlKey || e.metaKey) && e.key === "Enter") {
        e.preventDefault();
        document.getElementById("pengaduanForm").submit();
    }

    // Escape to close search results
    if (e.key === "Escape") {
        document.getElementById("searchResults").style.display = "none";
    }
});

// --- FORM FIELD ANIMATIONS ---
document
    .querySelectorAll(".form-input, .form-select, .form-textarea")
    .forEach(function (element) {
        element.addEventListener("focus", function () {
            this.parentElement.classList.add("focused");
        });

        element.addEventListener("blur", function () {
            this.parentElement.classList.remove("focused");
        });
    });

// --- PROGRESSIVE WEB APP FEATURES ---

// Check if user is online
function updateOnlineStatus() {
    var status = navigator.onLine ? "online" : "offline";
    if (status === "offline") {
        var offlineAlert = document.createElement("div");
        offlineAlert.className =
            "fixed top-4 right-4 bg-yellow-100 border-yellow-400 text-yellow-700 px-4 py-3 rounded shadow-lg z-50";
        offlineAlert.innerHTML =
            '<i class="fas fa-wifi mr-2"></i>Anda sedang offline. Form akan tersimpan otomatis.';
        document.body.appendChild(offlineAlert);

        setTimeout(function () {
            if (offlineAlert.parentNode) {
                offlineAlert.parentNode.removeChild(offlineAlert);
            }
        }, 5000);
    }
}

window.addEventListener("online", updateOnlineStatus);
window.addEventListener("offline", updateOnlineStatus);

// --- ACCESSIBILITY ENHANCEMENTS ---

// Focus trap for modals (if any)
function trapFocus(element) {
    var focusableElements = element.querySelectorAll(
        'a[href], button, textarea, input[type="text"], input[type="radio"], input[type="checkbox"], select'
    );
    var firstFocusableElement = focusableElements[0];
    var lastFocusableElement = focusableElements[focusableElements.length - 1];

    element.addEventListener("keydown", function (e) {
        if (e.key === "Tab") {
            if (e.shiftKey) {
                if (document.activeElement === firstFocusableElement) {
                    lastFocusableElement.focus();
                    e.preventDefault();
                }
            } else {
                if (document.activeElement === lastFocusableElement) {
                    firstFocusableElement.focus();
                    e.preventDefault();
                }
            }
        }
    });
}

// --- PERFORMANCE OPTIMIZATIONS ---

// Debounce function for better performance
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Throttle function for scroll events
function throttle(func, limit) {
    let inThrottle;
    return function () {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => (inThrottle = false), limit);
        }
    };
}

// --- ANALYTICS AND TRACKING (Optional) ---

// Track form interactions
function trackEvent(category, action, label) {
    if (typeof gtag !== "undefined") {
        gtag("event", action, {
            event_category: category,
            event_label: label,
        });
    }
}

// Track form start
var formStarted = false;
document
    .querySelectorAll(
        "#pengaduanForm input, #pengaduanForm select, #pengaduanForm textarea"
    )
    .forEach(function (element) {
        element.addEventListener("input", function () {
            if (!formStarted) {
                trackEvent("Form", "start", "pengaduan_form");
                formStarted = true;
            }
        });
    });

// --- ERROR HANDLING ---

window.addEventListener("error", function (e) {
    console.error("JavaScript Error:", e.error);
    // You can send this to your logging service
});

window.addEventListener("unhandledrejection", function (e) {
    console.error("Unhandled Promise Rejection:", e.reason);
    // You can send this to your logging service
});

// --- UTILS ---

// Format coordinate display
function formatCoordinates(lat, lon) {
    return `${Math.abs(lat).toFixed(6)}°${lat >= 0 ? "N" : "S"}, ${Math.abs(
        lon
    ).toFixed(6)}°${lon >= 0 ? "E" : "W"}`;
}

// Convert coordinates to different formats
function convertCoordinates(lat, lon, format = "decimal") {
    switch (format) {
        case "dms":
            return {
                lat: convertToDMS(lat, "lat"),
                lon: convertToDMS(lon, "lon"),
            };
        default:
            return {
                lat: lat,
                lon: lon,
            };
    }
}

function convertToDMS(coordinate, type) {
    var absolute = Math.abs(coordinate);
    var degrees = Math.floor(absolute);
    var minutesNotTruncated = (absolute - degrees) * 60;
    var minutes = Math.floor(minutesNotTruncated);
    var seconds = Math.floor((minutesNotTruncated - minutes) * 60);
    var direction =
        coordinate >= 0
            ? type === "lat"
                ? "N"
                : "E"
            : type === "lat"
            ? "S"
            : "W";

    return `${degrees}°${minutes}'${seconds}"${direction}`;
}

// Distance calculation between two points
function calculateDistance(lat1, lon1, lat2, lon2) {
    var R = 6371; // Radius of the Earth in kilometers
    var dLat = ((lat2 - lat1) * Math.PI) / 180;
    var dLon = ((lon2 - lon1) * Math.PI) / 180;
    var a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos((lat1 * Math.PI) / 180) *
            Math.cos((lat2 * Math.PI) / 180) *
            Math.sin(dLon / 2) *
            Math.sin(dLon / 2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    var distance = R * c; // Distance in kilometers
    return distance;
}
