FROM       gliderlabs/alpine:3.1
MAINTAINER Nick Schuch

RUN apk --update add ca-certificates

ADD api /usr/local/bin/api
RUN chmod a+x /usr/local/bin/api

ADD seed /usr/local/bin/seed
RUN chmod a+x /usr/local/bin/seed

ADD list /usr/local/bin/list
RUN chmod a+x /usr/local/bin/list

CMD ["api"]
