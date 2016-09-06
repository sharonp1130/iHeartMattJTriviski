package help.me.orm.entity;

import javax.annotation.Generated;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;

@Generated(value="Dali", date="2016-08-23T13:57:53.610-0700")
@StaticMetamodel(Review.class)
public class Review_ {
	public static volatile SingularAttribute<Review, Integer> reviewId;
	public static volatile SingularAttribute<Review, Float> rating;
	public static volatile SingularAttribute<Review, String> message;
	public static volatile SingularAttribute<Review, Long> createdAt;
	public static volatile SingularAttribute<Review, Long> updatedAt;
	public static volatile SingularAttribute<Review, User> reviewer;
	public static volatile SingularAttribute<Review, User> provider;
}
