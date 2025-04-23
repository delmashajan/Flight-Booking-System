<!DOCTYPE html>
<html>
<head>
    <title>Flight Search</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <h1 style="text-align: center">Flight Booking System</h1>
    
    <!-- Login/Register Section -->
    <div id="authSection">
        <h2 style="text-align: center">Authentication</h2>
        <div style="text-align: center">
            <button style="margin-right: 10px; background-color: palegreen;" onclick="showRegisterForm()">Register</button>
            <button style="background-color: lightblue;" onclick="showLoginForm()">Login</button>
        </div>
        
        <div id="registerForm" style="display: none; margin-top: 20px; text-align: center;">
            <h3>Register</h3>
            <form id="registerFormElement">
                <div>
                    <label>Name:</label>
                    <input type="text" id="registerName" required>
                </div>
                <div style="margin-top: 10px">
                    <label>Email:</label>
                    <input type="email" id="registerEmail" required>
                </div>
                <div style="margin-top: 10px">
                    <label>Password:</label>
                    <input type="password" id="registerPassword" required>
                </div>
                <div style="margin-top: 10px">
                    <label>Confirm Password:</label>
                    <input type="password" id="registerPasswordConfirmation" required>
                </div>
                <button style="margin-top: 10px" type="submit">Register</button>
            </form>
        </div>
        
        <div id="loginForm" style="display: none; margin-top: 20px; text-align: center;">
            <h3>Login</h3>
            <form id="loginFormElement">
                <div>
                    <label>Email:</label>
                    <input type="email" id="loginEmail" required>
                </div>
                <div style="margin-top: 10px ">
                    <label>Password:</label>
                    <input type="password" id="loginPassword" required>
                </div>
                <button style="margin-top: 10px" type="submit">Login</button>
            </form>
        </div>
    </div>
    
    <!-- Flight Search Section -->
    <div id="searchSection" style="display: none;">
        <h2>Search Flights</h2>
        <form id="searchForm">
            <div>
                <label>Origin:</label>
                <input type="text" id="origin" placeholder="PNQ" required>
            </div>
            <div style="margin-top: 10px">
                <label>Destination:</label>
                <input type="text" id="destination" placeholder="DEL" required>
            </div>
            <div style="margin-top: 10px">
                <label>Departure Date:</label>
                <input type="date" id="departureDate" required>
            </div>
            <div style="margin-top: 10px">
                <label>Passengers:</label>
                <input type="number" id="passengerCount" min="1" max="10" value="1" required>
            </div>
            <button style="margin-top: 10px" type="submit">Search</button>
        </form>
    </div>
    
    <div id="searchResults"></div>
    
    <div id="bookingForm" style="display: none;">
        <h2>Book Flight</h2>
        <form id="bookFlightForm">
            <input type="hidden" id="flightId">
            <div id="passengerDetails"></div>
            <button type="submit">Confirm Booking</button>
        </form>
    </div>
    
    <script>
        let authToken = null;
        let currentUser = null;
        
        // Show/hide forms
        function showRegisterForm() {
            document.getElementById('registerForm').style.display = 'block';
            document.getElementById('loginForm').style.display = 'none';
        }
        
        function showLoginForm() {
            document.getElementById('loginForm').style.display = 'block';
            document.getElementById('registerForm').style.display = 'none';
        }
        
        // Handle registration
        document.getElementById('registerFormElement').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const name = document.getElementById('registerName').value;
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;
            const passwordConfirmation = document.getElementById('registerPasswordConfirmation').value;
            
            try {
                const response = await axios.post('/api/register', {
                    name: name,
                    email: email,
                    password: password,
                    password_confirmation: passwordConfirmation
                });
                
                alert('Registration successful! Please login.');
                showLoginForm();
            } catch (error) {
                console.error('Registration failed:', error.response.data);
                alert('Registration failed: ' + JSON.stringify(error.response.data));
            }
        });
        
        // Handle login
        document.getElementById('loginFormElement').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            
            try {
                const response = await axios.post('/api/login', {
                    email: email,
                    password: password
                });
                
                authToken = response.data.access_token;
                currentUser = email;
                
                // Hide auth section, show search section
                document.getElementById('authSection').style.display = 'none';
                document.getElementById('searchSection').style.display = 'block';
                
                alert('Login successful!');
            } catch (error) {
                console.error('Login failed:', error.response.data);
                alert('Login failed: ' + (error.response.data.error || 'Invalid credentials'));
            }
        });
        
        // Search flights
        document.getElementById('searchForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (!authToken) {
                alert('Please login first');
                return;
            }
            
            const origin = document.getElementById('origin').value;
            const destination = document.getElementById('destination').value;
            const departureDate = document.getElementById('departureDate').value;
            const passengerCount = document.getElementById('passengerCount').value;
            
            try {
                const response = await axios.get('/api/flights/search', {
                    params: {
                        origin: origin,
                        destination: destination,
                        departure_date: departureDate,
                        passenger_count: passengerCount
                    },
                    headers: {
                        'Authorization': `Bearer ${authToken}`
                    }
                });
                
                displayResults(response.data);
            } catch (error) {
                console.error('Search failed:', error.response.data);
                alert('Search failed: ' + (error.response.data.message || 'Error searching flights'));
            }
        });
        
        // Display search results
        function displayResults(flights) {
            const resultsDiv = document.getElementById('searchResults');
            resultsDiv.innerHTML = '';
            
            if (flights.length === 0) {
                resultsDiv.innerHTML = '<p>No flights found matching your criteria.</p>';
                return;
            }
            
            flights.forEach(flight => {
                const flightDiv = document.createElement('div');
                flightDiv.style.border = '1px solid #ccc';
                flightDiv.style.padding = '10px';
                flightDiv.style.margin = '10px 0';
                
                flightDiv.innerHTML = `
                    <h3>${flight.airline} (${flight.airline_code}${flight.flight_number})</h3>
                    <p>${flight.origin} → ${flight.destination}</p>
                    <p>Departure: ${new Date(flight.departure).toLocaleString()}</p>
                    <p>Arrival: ${new Date(flight.arrival).toLocaleString()}</p>
                    <p>Duration: ${flight.duration}</p>
                    <p>Price: ₹${flight.price}</p>
                    <p>Available Seats: ${flight.available_seats}</p>
                    <button onclick="showBookingForm('${flight.id}', ${document.getElementById('passengerCount').value})">Book Now</button>
                `;
                
                resultsDiv.appendChild(flightDiv);
            });
        }
        
        // Show booking form
        window.showBookingForm = function(flightId, passengerCount) {
            document.getElementById('flightId').value = flightId;
            
            const passengerDetailsDiv = document.getElementById('passengerDetails');
            passengerDetailsDiv.innerHTML = '';
            
            for (let i = 1; i <= passengerCount; i++) {
                passengerDetailsDiv.innerHTML += `
                    <h4>Passenger ${i}</h4>
                    <div>
                        <label>Name:</label>
                        <input type="text" name="passenger_name_${i}" required>
                    </div>
                    <div>
                        <label>Age:</label>
                        <input type="number" name="passenger_age_${i}" min="1" max="120" required>
                    </div>
                `;
            }
            
            document.getElementById('bookingForm').style.display = 'block';
        };
        
        // Handle booking submission
        document.getElementById('bookFlightForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (!authToken) {
                alert('Please login first');
                return;
            }
            
            const flightId = document.getElementById('flightId').value;
            const passengerCount = document.getElementById('passengerCount').value;
            
            // Collect passenger details
            const passengerDetails = [];
            for (let i = 1; i <= passengerCount; i++) {
                const name = document.querySelector(`input[name="passenger_name_${i}"]`).value;
                const age = document.querySelector(`input[name="passenger_age_${i}"]`).value;
                
                passengerDetails.push({
                    name: name,
                    age: age
                });
            }
            
            try {
                const response = await axios.post('/api/bookings', {
                    flight_id: flightId,
                    passenger_count: passengerCount,
                    passenger_details: passengerDetails
                }, {
                    headers: {
                        'Authorization': `Bearer ${authToken}`,
                        'Content-Type': 'application/json'
                    }
                });
                
                alert('Booking confirmed!');
                document.getElementById('bookingForm').style.display = 'none';
            } catch (error) {
                console.error('Booking failed:', error.response.data);
                alert('Booking failed: ' + (error.response.data.message || 'Error processing booking'));
            }
        });
    </script>
</body>
</html>