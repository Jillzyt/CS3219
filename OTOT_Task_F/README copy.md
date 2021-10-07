```
Student Name: Zeng Yu Ting
Matriculation Number: A0202284N

Link to github repository: https://github.com/Jillzyt/CS3219/tree/master/OTOT_Task_A2
```

# Set up 
Before Step 1, make sure you have docker installed and enabled kubernetes in docker as shown in the image below.

<img src="./images/dockerscreenshot.png" width="1000" height="500">
<br>

After you check the box, press on apply & restart to apply and restart.

# kubectl commands to deploy image, configure service and access deployed image through the service.

```
# Create the Deployment by running the following command
kubectl apply -f deployment.yaml

# Run to check if the Deployment was created.
kubectl get deployments

# Run to expose the service to access to it
kubectl expose deployment taska2 --name=taska2 --type=LoadBalancer --port 80 --target-port 3000
```

Now you can go to localhost:80 to check see this message 'Users shown'

# Any other relevant learnings
- We need to deploy an image to remote repository on docker before being able to deploy it to kubernetes. (I think... This is what I have understood from the guides)

