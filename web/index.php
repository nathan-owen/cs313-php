<html>
  <head>
    <title>Welcome Home</title>
    <script src="scripts.js"></script>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li class="active"><a href="index.html">Home</a></li>
          <li><a href="assignments.php">Assignments</a></li>
          <li class="right"> <a href="#">
            <?php
              echo date("m/d/Y -- h:ia");
            ?>
          </a>
          </li>
        </ul>
      </nav>
    </header>

    <main>
      <div>
        <p class="title">
          Welcome to my CS 313 Web Engineering II Page!
        </p>
        <p>
            I am an IT manager for a midsized credit union in Oklahoma. Straight from my LinkedIn Profile:
          "Experienced in system and network administration, primarily in VMware Data Center and Desktop Virtualization, 
          and Cisco Unified Computing Systems. Experienced software developer in many languages including C# and Java.
          Gained extensive knowledge and training from Cisco and VMware in relation to networking and data center administration. 
          Developed very thorough and efficient troubleshooting skills as well as software development best practices."
        </p>
        <img class="me" src="images/me.jpg">
        <p>
            Basically what that means is I have a lot of experience in managing datacenter equipment in order to keep a business network
          online and functional. While I do primarily work on the backend datacenter, you can also call me about any kind of computer
          issue and I'll help you out!
        </p>
        <p>
            I am a Software Engineering Major but I much more than that! I have created countless programs for IT operations to improve
          productivity and efficiency. I recently discovered that doing that kind of had a term of its own: <a href="https://en.wikipedia.org/wiki/DevOps">DevOps</a>
        </p>

        <button onclick="isItHalloween()">Is It Halloween?</button>
        <button onclick="isItChristmas()">Is It Christmas?</button>

        <h3 id="answer"></h3>
      </div>
    </main>
  </body>
</html>