# Laravel Task

Terms of reference (TOR) for the task "Displaying a list of tasks":
As an analogue, you can see: https://play.picoctf.org/practice

General description:
Develop a page that will display a list of available tasks for the user, with the ability to filter, sort and search. The user will be able to see basic information about each task, such as title, description, category, scores and status (solved/unsolved).

Functional requirements:

Creating a Job List Page: Design a page that will display a list of available jobs.
Task information display: Each task must contain the following information: title, description, category, scores and status (solved/unsolved).
Item Filtering: Provide the ability to filter items by category, score, and status (solved/unresolved).
Task Sorting: Add the ability to sort tasks by category, score, and status.
Search for tasks: Implement the function of searching for tasks by name or description.
User interface:

Job List Page: Create a user interface that will display a list of jobs.
Filtering and Sorting: Add controls to select categories, score range and status. Provide buttons to apply filtering and sorting.
Search field: Add an input field where the user can enter a keyword to search for jobs.
Information Display: Each task should be presented as a cell or card containing a title, description, category, score, and status. When you click on a task, you can go to its detailed page.

Technical requirements:

Frontend: Use React to develop the frontend part of the application.
Backend: Use PHP to process requests, get job data and filter/sort them.
Data storage: Jobs and their information can be stored in a database or file system.
API: Create an API for getting a list of tasks, filtering, sorting and searching.
Routing: Implement routing on the frontend to go to the job detail page.
Additional requirements:

Pagination: If the number of tasks is large, implement pagination to display page by page.
Caching: If appropriate, add a caching mechanism to improve performance.