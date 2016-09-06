package help.me.orm.entity;

import javax.annotation.Generated;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;

@Generated(value="Dali", date="2016-05-29T22:42:49.817-0700")
@StaticMetamodel(Location.class)
public class Location_ {
	public static volatile SingularAttribute<Location, Integer> locationId;
	public static volatile SingularAttribute<Location, User> user;
	public static volatile SingularAttribute<Location, Double> longitude;
	public static volatile SingularAttribute<Location, Double> latitude;
	public static volatile SingularAttribute<Location, Boolean> isExpired;
	public static volatile SingularAttribute<Location, Long> createdAt;
}
