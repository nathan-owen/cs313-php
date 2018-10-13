CREATE TABLE tickets (
    id SERIAL PRIMARY KEY,
    title VARCHAR,
    description TEXT,
    affectedSystems TEXT,
    rollbackPlan TEXT,
    dateSubmitted TIMESTAMP,
    requestor INT references users(id),
    state VARCHAR,
    status VARCHAR,
    approvedBy INT references users(id),
    dateUpdated TIMESTAMP,
    dateClosed TIMESTAMP
);

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR,
    password VARCHAR,
    email VARCHAR,
    security INT,
    name VARCHAR,
    phoneNumber VARCHAR
);

CREATE TABLE comments (
    id SERIAL PRIMARY KEY,
    ticketID INT references tickets(id),
    content TEXT,
    datePosted TIMESTAMP,
    userID INT references users(id)
);

