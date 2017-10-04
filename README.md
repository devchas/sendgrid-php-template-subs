### An example of how to leverage transactional templates and substitutions using SendGrid's PHP library

In email.php, create the customers array, insert sender/template info, and then...

Build the image
```
docker build -t TAG_NAME .
```

Run the container
```
docker run -it --rm -v "$(pwd)"/scripts:/usr/src/app -e SG_API_KEY={$SG_API_KEY} --name NAME TAG_NAME
```