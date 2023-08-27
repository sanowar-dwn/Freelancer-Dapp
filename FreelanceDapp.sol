// SPDX-License-Identifier: GPL-3.0

pragma solidity >=0.7.0 <0.9.0;

contract FreelanceDapp {
    // Struct to represent a client
    struct Client {
        string username;
        address wallet_address;
    }

    // Mapping to track client registrations
    mapping(address => bool) public isClient;
    // Mapping to store client information using a numeric index
    mapping(uint256 => Client) public clients;
    // Counter to keep track of the number of clients
    uint256 public clientCount;

    // Struct to represent a freelancer
    struct Freelancer {
        string username;
        address wallet_address;
    }

    // Mapping to track freelancer registrations
    mapping(address => bool) public isFreelancer;
    // Mapping to store freelancer information using a numeric index
    mapping(uint256 => Freelancer) public freelancers;
    // Counter to keep track of the number of freelancers
    uint256 public freelancerCount;

    // Struct to represent a project
    struct Project {
        string title;
        string smallDescription;
        string projectDescription;
        uint256 budget;
        uint256 escrowAmount; // Escrowed amount for the project
        address client;
        address freelancer;
        bool isAssigned;
        bool isWorkSubmitted; // Status of work submission
        string projectLink;   // Link to the project's work
    }
    // Mapping to store project information using a numeric index
    mapping(uint256 => Project) public projects;
    // Counter to keep track of the number of projects
    uint256 public projectCount;

    // Struct to represent a proposal for a project
    struct Proposal {
        uint256 projectId; // ID of the project being proposed for
        string description; // Description of the proposal
        address freelancer; // Address of the freelancer submitting the proposal
    }

    // Mapping to store project proposals using project ID
    mapping(uint256 => Proposal[]) public projectProposals;

    // Freelancers can submit proposals for projects
    function submitProposal(uint256 _projectId, string memory _description) public OnlyFreelancer {
        require(_projectId <= projectCount, "Invalid project ID");
        require(projects[_projectId].isAssigned == false, "This project has already been assigned");
        Proposal memory newProposal = Proposal({
            projectId: _projectId,
            description: _description,
            freelancer: msg.sender
        });

        projectProposals[_projectId].push(newProposal);
    }

    // Clients can view proposals for a project
    function getProjectProposals(uint256 _projectId) public view returns (Proposal[] memory) {
        require(_projectId <= projectCount, "Invalid project ID");
        return projectProposals[_projectId];
    }

    // Clients can assign a project to a freelancer
    function assignProject(uint256 _projectId, uint256 _proposalIndex) public OnlyClient {
        require(_projectId <= projectCount, "Invalid project ID");

        Proposal[] storage proposals = projectProposals[_projectId];
        require(_proposalIndex < proposals.length, "Invalid proposal index");

        require(projects[_projectId].client == msg.sender, "Only the client who posted the project can assign it");

        require(projects[_projectId].isAssigned == false, "This project has already been assigned");
        Proposal storage selectedProposal = proposals[_proposalIndex];

        projects[_projectId].freelancer = selectedProposal.freelancer;
        projects[_projectId].isAssigned = true;
    }

    // Clients can post new projects
    function postProject(
        string memory _title,
        string memory _smallDescription,
        string memory _projectDescription,
        uint256 _budget
    ) public OnlyClient {
        projectCount++;
        projects[projectCount] = Project(
            _title,
            _smallDescription,
            _projectDescription,
            _budget,
            0, // Initialize escrowAmount to 0
            msg.sender,
            address(0),
            false, 
            false,
            ""
        );
    }

    // Clients can deposit funds into escrow for a project
    function depositEscrow(uint256 _projectId) public payable OnlyClient {
        require(_projectId <= projectCount, "Invalid project ID");
        Project storage project = projects[_projectId];

        require(project.client == msg.sender, "Only the client who posted the project can deposit escrow");
        require(project.isAssigned == false, "Cannot deposit escrow for an assigned project");
        require(msg.value == project.budget, "Escrow amount must match project budget");

        project.escrowAmount = msg.value;
    }

    // Clients can release funds to the freelancer
    function releaseFunds(uint256 _projectId) public OnlyClient {
        require(_projectId <= projectCount, "Invalid project ID");
        Project storage project = projects[_projectId];

        require(project.client == msg.sender, "Only the client who posted the project can release funds");
        require(project.isAssigned == true, "Project must be assigned to release funds");
        require(project.isWorkSubmitted == true, "Project must be submitted");

        address payable freelancer = payable(project.freelancer);
        uint256 amount = project.escrowAmount;
        project.escrowAmount = 0;
        project.isAssigned = false;
        freelancer.transfer(amount);
    }

    // Freelancers can submit their work for a project
    function submitWork(uint256 _projectId, string memory _projectLink) public OnlyFreelancer {
        require(_projectId <= projectCount, "Invalid project ID");
        Project storage project = projects[_projectId];

        require(project.freelancer == msg.sender, "Only the assigned freelancer can submit work");
        require(project.isAssigned == true, "Project must be assigned before work submission");
        require(project.isWorkSubmitted == false, "Work has already been submitted for this project");

        project.projectLink = _projectLink;
        project.isWorkSubmitted = true;
    }

    // Freelancers can join the platform
    function joinAsFreelancer(string memory _username) public {
        require(!isFreelancer[msg.sender], "You are already registered as a Freelancer");
        require(!isClient[msg.sender], "You are already registered as a Client");

        freelancerCount++;
        freelancers[freelancerCount] = Freelancer(_username, msg.sender);
        isFreelancer[msg.sender] = true;
    }

    // Modifier to restrict access to freelancers
    modifier OnlyFreelancer() {
        require(isFreelancer[msg.sender], "You do not have access, Only a Freelancer account can access this");
        _;
    }

    // Clients can join the platform
    function joinAsClient(string memory _username) public {
        require(!isClient[msg.sender], "You are already registered as a Client");
        require(!isFreelancer[msg.sender], "You are already registered as a Freelancer");

        clientCount++;
        clients[clientCount] = Client(_username, msg.sender);
        isClient[msg.sender] = true;
    }

    // Modifier to restrict access to clients
    modifier OnlyClient() {
        require(isClient[msg.sender], "You do not have access, Only a Client account can access this");
        _;
    }
}
