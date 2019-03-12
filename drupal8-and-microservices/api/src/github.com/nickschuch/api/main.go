package main

import (
	"flag"
	"fmt"
	"log"
	"net"

	"github.com/zemirco/uid"
	context "golang.org/x/net/context"
	grpc "google.golang.org/grpc"

	pb "github.com/nickschuch/articles"
)

var port = flag.Int("port", 8080, "The server port")

type articlesServer struct {
	articles map[string]*pb.Article
}

func (a *articlesServer) Create(ctx context.Context, in *pb.CreateRequest) (*pb.CreateResponse, error) {
	// Generate a new hash for this new peice of content.
	u := uid.New(20)

	// Add it to this APIs in memory storage.
	a.articles[u] = in.Article

	// Assign this ID to our article as well.
	a.articles[u].Id = u

	log.Println("Creating new article:", u)

	// Pass back the hash, so the user has an ID to what they created.
	return &pb.CreateResponse{Article: in.Article}, nil
}

func (a *articlesServer) Get(ctx context.Context, in *pb.GetRequest) (*pb.GetResponse, error) {
	log.Println("Querying for article with ID:", in.Id)

	// Do we have this item of content? If we do we should return it.
	if val, ok := a.articles[in.Id]; ok {
		return &pb.GetResponse{Article: val}, nil
	}

	return nil, fmt.Errorf("Cannot find content:", in.Id)
}

func (a *articlesServer) Update(ctx context.Context, in *pb.UpdateRequest) (*pb.UpdateResponse, error) {
	log.Println("Updating article:", in.Article.Id)
	a.articles[in.Article.Id] = in.Article
	return &pb.UpdateResponse{}, nil
}

func (a *articlesServer) Delete(ctx context.Context, in *pb.DeleteRequest) (*pb.DeleteResponse, error) {
	log.Println("Deleting article:", in.Id)

	// Loop over all the provided IPs, and remove the article if it exists.
	if _, ok := a.articles[in.Id]; ok {
		delete(a.articles, in.Id)
	}

	return &pb.DeleteResponse{}, nil
}

func (a *articlesServer) List(ctx context.Context, in *pb.ListRequest) (*pb.ListResponse, error) {
	log.Println("Listing all articles")

	resp := new(pb.ListResponse)

	// Rebuild the list from a map to a slice.
	//   eg. map[string]*pb.Article to []*pb.Article
	for _, a := range a.articles {
		resp.Articles = append(resp.Articles, a)
	}

	return resp, nil
}

func main() {
	flag.Parse()

	var opts []grpc.ServerOption

	log.Println("Starting Articles API server")

	listen, err := net.Listen("tcp", fmt.Sprintf(":%d", *port))
	if err != nil {
		log.Fatalf("Failed to listen: %v", err)
	}

	// Create a new server.
	s := new(articlesServer)
	s.articles = make(map[string]*pb.Article)

	grpcServer := grpc.NewServer(opts...)
	pb.RegisterArticlesServer(grpcServer, s)
	grpcServer.Serve(listen)
}
