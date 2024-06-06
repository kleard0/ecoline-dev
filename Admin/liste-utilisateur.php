<?php
                    /**
                     * Connect to the database and fetch data from the "message" table.
                     * Display the fetched data in a table.
                     */

                    // Connect to your database
                    $servername = "localhost";
                    $username = "message";
                    $password = "4VZzATv&jiCV5Jo*5m5i@!X^#PbK9ijx";
                    $dbname = "ecoline";

                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch data from the database
                    $sql = "SELECT destinataire_id,message_content, message_text FROM message";
                    $result = $conn->query($sql);

                    // Display the data
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<p>ID Utilisateur: " . $row["destinataire_id"] . "</p>";
                            echo "<p>Sujet: " . $row["message_content"] . "</p>";
                            echo "<p>Message: " . $row["message_text"] . "</p>";
                            echo "<table>";
                            echo "<tr><th>ID Utilisateur</th><th>Sujet</th><th>Message</th></tr>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["destinataire_id"] . "</td>";
                                echo "<td>" . $row["message_content"] . "</td>";
                                echo "<td>" . $row["message_text"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                    } else {
                        echo "No data found.";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
