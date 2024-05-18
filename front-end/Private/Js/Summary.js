const ministers = [
    {
        name: 'Alice Johnson',
        age: 45,
        sex: 'Female',
        party: 'Progressive Party',
        shortMission: 'Education Reform',
        detailedMission: 'Alice aims to implement comprehensive education reforms that focus on reducing disparities, increasing access to quality education, and integrating technology in classrooms.',
        leaning: 'Left',
        image: '../img/Alice.jpeg'
    },
    {
        name: 'Bob Smith',
        age: 52,
        sex: 'Male',
        party: 'Conservative Alliance',
        shortMission: 'Economic Damnation',
        detailedMission: 'Bob is focused on himself, he says bamboos are very tasty',
        leaning: 'Right',
        image: '../img/Smith.jpg'
    },
    {
        name: 'Thor',
        age: 1500,
        sex: 'Male',
        party: 'Valhalla Legion',
        shortMission: 'Human Rights',
        detailedMission: 'Thor is quite focused on protecting human rights, he says he wants to bring his mjolnir down on justice, no idea what that means.',
        leaning: 'Neutral',
        image: '../img/Thor.jpg'
    },
    // Add more ministers as needed
];

document.addEventListener('DOMContentLoaded', () => {
    const profilesContainer = document.getElementById('profiles');
    const modal = document.getElementById('modal');
    const closeButton = document.querySelector('.close-button');
    const profileDetails = document.getElementById('profile-details');

    ministers.forEach(minister => {
        const profileCard = document.createElement('div');
        profileCard.classList.add('profile-card');
        profileCard.innerHTML = `
            <img src="${minister.image}" alt="${minister.name}" class="profile-image">
            <h3>${minister.name}</h3>
            <p>Age: ${minister.age}</p>
            <p>Sex: ${minister.sex}</p>
            <p>Party: ${minister.party}</p>
            <p>Mission: ${minister.shortMission}</p>
            <button class="vote-button" data-name="${minister.name}">Vote</button>
        `;
        profileCard.querySelector('.vote-button').addEventListener('click', (e) => {
            e.stopPropagation();
            handleVote(minister.name);
        });
        profileCard.addEventListener('click', () => {
            profileDetails.innerHTML = `
                <h2>${minister.name}</h2>
                <img src="${minister.image}" alt="${minister.name}" class="profile-image">
                <p><strong>Age:</strong> ${minister.age}</p>
                <p><strong>Sex:</strong> ${minister.sex}</p>
                <p><strong>Party:</strong> ${minister.party}</p>
                <p><strong>Mission:</strong> ${minister.detailedMission}</p>
                <p><strong>Leaning:</strong> ${minister.leaning}</p>
            `;
            modal.style.display = 'block';
        });
        profilesContainer.appendChild(profileCard);
    });

    closeButton.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', event => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    checkIfVoted();
});

function handleVote(ministerName) {
    const encryptedVoteToken = localStorage.getItem('encryptedVoteToken');
    if (encryptedVoteToken) {
        alert('You have already voted.');
        return;
    }

    const userConfirmed = confirm(`Are you sure you want to vote for ${ministerName}?`);
    if (!userConfirmed) {
        return;
    }

    const voteToken = generateRandomToken();
    const secretKey = deriveKeyFromToken(voteToken);
    const encryptedToken = encryptToken(voteToken, secretKey);
    localStorage.setItem('encryptedVoteToken', encryptedToken);
    localStorage.setItem('voteSecretKey', secretKey.toString()); // Store the key for later validation

    alert('Your vote has been cast.');
    updateVoteButtons();
}

function checkIfVoted() {
    const encryptedVoteToken = localStorage.getItem('encryptedVoteToken');
    if (encryptedVoteToken) {
        updateVoteButtons();
    }
}

function updateVoteButtons() {
    const voteButtons = document.querySelectorAll('.vote-button');
    voteButtons.forEach(button => {
        button.disabled = true;
        button.textContent = 'Vote (already voted)';
    });
}

function generateRandomToken() {
    return Math.random().toString(36).substring(2) + Date.now().toString(36);
}

function deriveKeyFromToken(token) {
    const salt = CryptoJS.lib.WordArray.random(128 / 8);
    return CryptoJS.PBKDF2(token, salt, { keySize: 256 / 32, iterations: 1000 });
}

function encryptToken(token, key) {
    return CryptoJS.AES.encrypt(token, key).toString();
}