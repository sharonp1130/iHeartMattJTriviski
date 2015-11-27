package help.me.orm.entity;

import java.util.Date;
import javax.annotation.Generated;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;

@Generated(value="Dali", date="2015-11-26T18:29:50.414-0800")
@StaticMetamodel(Location.class)
public class Location_ {
	public static volatile SingularAttribute<Location, Integer> locationId;
	public static volatile SingularAttribute<Location, Double> longitude;
	public static volatile SingularAttribute<Location, Double> latitude;
	public static volatile SingularAttribute<Location, Date> createdAt;
	public static volatile SingularAttribute<Location, Date> updatedAt;
	public static volatile SingularAttribute<Location, User> user;
}
